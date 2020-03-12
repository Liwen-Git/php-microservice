<?php


namespace App\Rpc;


use Hyperf\RpcClient\AbstractServiceClient;

class LotteryConsumerService extends AbstractServiceClient
{
    protected $serviceName = 'LotteryService';

    protected $protocol = 'jsonrpc-http';

    public function storePrize()
    {
        return $this->__request(__FUNCTION__, []);
    }

    public function lotteryWithoutGo(int $prizeId, int $userId)
    {
        return $this->__request(__FUNCTION__, compact('prizeId', 'userId'));
    }

    public function lotteryWithGo(int $prizeId, int $userId)
    {
        return $this->__request(__FUNCTION__, compact('prizeId', 'userId'));
    }
}