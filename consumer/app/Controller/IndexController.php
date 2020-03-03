<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Rpc\CalculatorConsumerService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * Class IndexController
 * @package App\Controller
 *
 * @AutoController()
 */
class IndexController extends AbstractController
{
    /**
     * @Inject
     * @var CalculatorConsumerService
     */
    private $calculatorService;

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function calculator()
    {
        return $this->calculatorService->add(5, 3);
    }
}
