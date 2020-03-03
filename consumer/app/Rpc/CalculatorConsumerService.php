<?php


namespace App\Rpc;


use Hyperf\RpcClient\AbstractServiceClient;

class CalculatorConsumerService extends AbstractServiceClient
{
    protected $serviceName = 'CalculatorService';

    protected $protocol = 'jsonrpc-http';

    public function add(int $a, int $b): int
    {
        return $this->__request(__FUNCTION__, compact('a', 'b'));
    }

    public function minus(int $a, int $b): int
    {
        return $this->__request(__FUNCTION__, compact('a', 'b'));
    }
}