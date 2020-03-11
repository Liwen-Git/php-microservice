<?php


namespace App\Controller;

use App\Rpc\LotteryConsumerService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * Class LotteryController
 * @package App\Controller
 *
 * @AutoController()
 */
class LotteryController extends AbstractController
{
    /**
     * @Inject()
     * @var LotteryConsumerService
     */
    private $lotteryService;

    public function initPrize()
    {
        $data = $this->lotteryService->storePrize();
        return $data;
    }
}