<?php
  namespace App\Contracts;

  interface IOrderService {
    public function saveOrderData($data);
  }