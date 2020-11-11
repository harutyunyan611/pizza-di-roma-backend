<?php
  namespace App\Services;

  use App\Contracts\IOrderService;
  use App\Contracts\IOrderRepository;
  use Auth;

  class OrderService implements IOrderService {

    protected $orderRepository;

    public function __construct(IOrderRepository $orderRepository) {
      $this->orderRepository = $orderRepository;
    }

    public function getOrders() {
      return $this->orderRepository->getMyOrders();
    }

    public function saveOrderData($data) {
      $result = $this->orderRepository->save($data);

      return $result;
    }

    public function saveUnAuthOrderData($data) {
      $result = $this->orderRepository->saveUnAuthOrder($data);

      return $result;
    }
  }