<?php
  namespace App\Contracts;

  interface IPizzaRepository {
    public function save($data);
    public function getAllPizzas();
  }