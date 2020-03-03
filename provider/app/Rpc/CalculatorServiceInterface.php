<?php

namespace App\Rpc;

interface CalculatorServiceInterface
{
    /**
     * @param int $a
     * @param int $b
     * @return int
     */
    public function add(int $a, int $b): int;

    /**
     * @param int $a
     * @param int $b
     * @return int
     */
    public function minus(int $a, int $b): int;
}