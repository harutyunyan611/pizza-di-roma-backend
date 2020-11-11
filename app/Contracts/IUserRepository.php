<?php

  namespace App\Contracts;

  interface IUserRepository {
    public function logIn($data);
    public function logOut();
    public function save($data);
  }