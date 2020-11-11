<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests\PizzaRequest;
use App\Contracts\IPizzaService;
use Exception;
use Symfony\Component\HttpFoundation\Response;


class PizzaController extends Controller
{
    protected $pizzaService;

    public function __construct(IPizzaService $pizzaService) {
        $this->pizzaService = $pizzaService;
    }

    public function store(PizzaRequest $request){
        $result = ['status' => Response::HTTP_CREATED];

        try {
            $result['data'] = $this->pizzaService->savePizzaData($request);
        } catch (Exception $e) {
            $result = [
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function pizzas() {
        return response()->json($this->pizzaService->getAll());
    }
}
