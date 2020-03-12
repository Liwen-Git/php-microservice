<?php


namespace App\Rpc;

use App\Model\Prize;
use App\Model\Winner;
use Hyperf\RpcServer\Annotation\RpcService;

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
        $prize->num = 10000;
        $prize->save();

        return $prize->toArray();
    }

    public function lotteryWithoutGo(int $prizeId, int $userId)
    {
        /**
         * @var Prize $prize
         */
        $prize = Prize::query()->find($prizeId);
        if ($prize->num > 0) {
            $prize->num -= 1;
            $prize->save();

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
        /**
         * @var Prize $prize
         */
        $prize = Prize::query()->find($prizeId);
        if ($prize->num > 0) {
            $result = parallel([
                function() use($prize) {
                    $prize->num -= 1;
                    $prize->save();

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