<?php
  namespace App\Repositories;

  use App\User;
  use Auth;
  use InvalidArgumentException;
  use App\Contracts\IUserRepository;

  class UserRepository implements IUserRepository {

    protected $model;

    public function __construct(User $model){
      $this->model = $model;
    }

    public function logIn($data) {
      $user = Auth::user();
      // return $user->createToken('authToken');
        return $user->createToken('authToken')->accessToken;
      $accessToken = $user->createToken('authToken')->accessToken;
      return $accessToken;
    }

    public function save($data) {
      $data['password'] = bcrypt($data['password']);
      $user = $this->model::create($data);
      return $user;
    }

    public function logOut(){
      Auth::user()->token()->revoke();
      return "Successfully logged out";
    }
  }
