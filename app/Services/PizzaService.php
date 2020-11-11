<?php
  namespace App\Services;

  use App\Contracts\IPizzaService;
  use App\Contracts\IPizzaRepository;

  class PizzaService implements IPizzaService {

    protected $pizzaRepository;

    public function __construct(IPizzaRepository $pizzaRepository) {
      $this->pizzaRepository = $pizzaRepository;
    }

    public function savePizzaData($data) {
      $result = $this->pizzaRepository->save($data);

      return $result;
    }

    public function getAll() {
      return $this->pizzaRepository->getAllPizzas();
    }
  }