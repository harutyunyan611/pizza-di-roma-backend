<?php 

  namespace App\Contracts;

  interface IUserService {

    public function loginUser($data);
    public function saveUserData($data);

  }