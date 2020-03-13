<?php


namespace App\Rpc;

use App\Model\Prize;
use App\Model\Winner;
use Hyperf\RpcServer\Annotation\RpcService;
use Hyperf\Utils\ApplicationContext;
use Redis;

/**
 * Class LotteryService
 * @package App\Rpc
 * @RpcService(name="LotteryService", protocol="jsonrpc-http", server="jsonrpc-http", publishTo="consul")
 */
class LotteryService
{
    public function storePrize()
    {
        $prize = new Prize();
        $name = '';
        for ($i=0; $i<5; $i++) {
            $item = chr(mt_rand(0xB0,0xD0)).chr(mt_rand(0xA1, 0xF0));
            // 转码
            $name .= iconv('GB2312', 'UTF-8', $item);
        }
        $prize->name = $name;
        $prize->num = 5000;
        $prize->save();

        $container = ApplicationContext::getContainer();
        $redis = $container->get(Redis::class);
        for ($i = 0; $i < $prize->num; $i++) {
            $redis->lPush('lottery_prize_num', 1);
        }

        return $prize->toArray();
    }

    public function lotteryWithoutGo(int $prizeId, int $userId)
    {
        $container = ApplicationContext::getContainer();
        $redis = $container->get(Redis::class);
        $count = $redis->lPop('lottery_prize_num');

        if ($count) {
            Prize::query()->find($prizeId)->decrement('num');

            $winner = new Winner();
            $winner->prize_id = $prizeId;
            $winner->user_id = $userId;
            $winner->save();

            return $winner->toArray();
        } else {
            return '奖品已发完!';
        }
    }

    public function lotteryWithGo(int $prizeId, int $userId)
    {
        $container = ApplicationContext::getContainer();
        $redis = $container->get(Redis::class);
        $count = $redis->lPop('lottery_prize_num');
        if ($count) {
            $result = parallel([
                function() use($prizeId) {
                    /**
                     * @var Prize $prize
                     */
                    $prize = Prize::query()->find($prizeId)->decrement('num');

                    return $prize->toArray();
                },
                function() use($prizeId, $userId) {
                    $winner = new Winner();
                    $winner->prize_id = $prizeId;
                    $winner->user_id = $userId;
                    $winner->save();

                    return $winner->toArray();
                }
            ]);

            return $result;
        } else {
            return '奖品已发完!';
        }
    }
}