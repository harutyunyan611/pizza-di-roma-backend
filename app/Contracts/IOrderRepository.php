<?php
  namespace App\Contracts;

  interface IOrderRepository {
    public function save($data);
  }