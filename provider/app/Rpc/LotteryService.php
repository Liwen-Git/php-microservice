<?php


namespace App\Rpc;

use App\Model\Prize;
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

    public function lotteryWithoutGo()
    {

    }

    public function lotteryWithGo()
    {

    }
}