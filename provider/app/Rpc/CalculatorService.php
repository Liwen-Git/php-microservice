<?php


namespace App\Rpc;

use Hyperf\RpcServer\Annotation\RpcService;

/**
 * Class CalculatorService
 * @package App\Rpc
 * @RpcService(name="CalculatorService", protocol="jsonrpc-http", server="jsonrpc-http", publishTo="consul")
 */
class CalculatorService implements CalculatorServiceInterface
{
    /**
     * @param int $a
     * @param int $b
     * @return int
     */
    public function add(int $a, int $b): int
    {
        return $a + $b;
    }

    /**
     * @param int $a
     * @param int $b
     * @return int
     */
    public function minus(int $a, int $b): int
    {
        return $a - $b;
    }
}