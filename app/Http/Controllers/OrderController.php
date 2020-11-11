<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests\OrderRequest;
use App\Requests\UnAuthOrderRequest;
use App\Pizza;
use App\Order;
use App\PizzaOrders;
use App\Contracts\IOrderService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(IOrderService $orderService) {
        $this->orderService = $orderService;
    }

    public function orders() {
        $result = ['status' => Response::HTTP_OK];

        try {
            $result['data'] = $this->orderService->getOrders();
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => json_encode($e->getMessage())
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function store(OrderRequest $request) {
        $result = ['status' => Response::HTTP_CREATED];

        try {
            $result['data'] = $this->orderService->saveOrderData($request->all());
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => json_encode($e->getMessage())
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function storeUnAuthOrder(UnAuthOrderRequest $request) {
        $result = ['status' => Response::HTTP_CREATED];

        try {
            $result['data'] = $this->orderService->saveUnAuthOrderData($request->all());
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => json_encode($e->getMessage())
            ];
        }

        return response()->json($result, $result['status']);
    }
}
