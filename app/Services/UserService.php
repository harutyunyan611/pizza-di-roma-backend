<?php
  namespace App\Services;

  use App\Contracts\IUserService;
  use App\Contracts\IUserRepository;
  use Exception;
  use Auth;
  use InvalidArgumentException;
  use Illuminate\Validation\ValidationException;
  use Symfony\Component\HttpFoundation\Response;

  class UserService implements IUserService {
    protected $userRepository;

    public function __construct(IUserRepository $userRepository) {
      $this->userRepository = $userRepository;
    }

    public function loginUser($data) {
      if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
        throw new InvalidArgumentException(json_encode(["email" => ["These credentials do not match our records"]]));
      }

      $result = $this->userRepository->logIn($data);

      return $result;
    }

    public function saveUserData($data) {

      $result = $this->userRepository->save($data);
      
      return $result;
    }

    public function logOut() {
      $result = $this->userRepository->logOut();

      return $result;
    }
  }