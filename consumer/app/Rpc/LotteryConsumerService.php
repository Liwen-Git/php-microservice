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
}