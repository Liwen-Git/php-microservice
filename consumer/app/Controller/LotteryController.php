<?php


namespace App\Controller;

use App\Rpc\LotteryConsumerService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;

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

    public function lotteryNoGo(RequestInterface $request)
    {
        $prizeId = $request->query('prize_id', 1);
        $userId = $request->query('user_id', 1);

        $data = $this->lotteryService->lotteryWithoutGo($prizeId, $userId);

        return $data;
    }

    public function lotteryGo(RequestInterface $request)
    {
        $prizeId = $request->query('prize_id', 1);
        $userId = $request->query('user_id', 1);

        $data = $this->lotteryService->lotteryWithGo($prizeId, $userId);

        return $data;
    }
}