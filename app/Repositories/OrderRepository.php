<?php
  namespace App\Repositories;

  use App\Contracts\IOrderRepository;
  use App\Order;
  use App\Pizza;
  use App\PizzaOrders;
  use App\User;
  use Auth;

  class OrderRepository implements IOrderRepository {
    
    protected $model;
    protected $pizzaModel;
    protected $pizzaOrdersModel;

    public function __construct(Order $model, Pizza $pizzaModel, PizzaOrders $pizzaOrdersModel) {
      $this->model = $model;
      $this->pizzaModel = $pizzaModel;
      $this->pizzaOrdersModel = $pizzaOrdersModel;
    }

    public function getMyOrders() {
      $response = $this->model::where('users_id', Auth::user()->id)->with(['pizzas'])->get();

      foreach ($response as $value) {
        $total = 0;
        foreach ($value['pizzas'] as $pizza) {
          $total = $total + $pizza->price * $pizza->pivot->count;
        }
        $value->total = $total;
      }

      return $response;
    }

    public function save($data) {
      $order = new $this->model;
      $order->users_id = Auth::guard('api')->user() ? Auth::guard('api')->user()->id : null;
      $order->first_name = $data['first_name'];
      $order->last_name = $data['last_name'];
      $order->address = $data['address'];
      $order->phone = $data['phone'];
      $order->save();
      

      foreach ($data['pizzas'] as $key => $value) {
        $pizzaOrder = new $this->pizzaOrdersModel;
        $pizzaOrder->orders_id = $order->id;
        $pizzaOrder->pizzas_id = $this->pizzaModel->where('name', $key)->first()->id;
        $pizzaOrder->count = $value;
        $pizzaOrder->save();
      }

      return "Your order is successfully received";
    }

    public function saveUnAuthOrder($data) {
      $order = new $this->model;
      $order->first_name = $data['first_name'];
      $order->last_name = $data['last_name'];
      $order->address = $data['address'];
      $order->phone = $data['phone'];
      $order->save();;

      foreach ($data['pizzas'] as $key => $value) {
        $pizzaOrder = new $this->pizzaOrdersModel;
        $pizzaOrder->orders_id = $order->id;
        $pizzaOrder->pizzas_id = $this->pizzaModel->where('name', $key)->first()->id;
        $pizzaOrder->count = $value;
        $pizzaOrder->save();
      }

      return "Your order is successfully received";
    }
  }