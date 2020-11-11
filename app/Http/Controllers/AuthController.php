<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
use Auth;
use App\Contracts\IUserService;
use App\Contracts\IUserRepository;
use App\Requests\SigninRequest;
use App\Requests\SignupRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

  protected $userService;
  
  public function __construct(IUserService $userService) {
    $this->userService = $userService;
  }

  public function signIn(SigninRequest $request) {
    $data = $request->all();
    $result = ['status' => Response::HTTP_OK];
    try {
      $result['token'] = $this->userService->loginUser($data);
    } catch (Exception $e) {
      $result = [
        'status' => Response::HTTP_UNAUTHORIZED,
        'error' => json_decode($e->getMessage())
      ];
    }
    return response()->json($result, $result['status']);
  }

  public function signUp(SignupRequest $request) {
    $data = $request->all();

    $result = ['status' => Response::HTTP_CREATED];

    try {
      $result['data'] = $this->userService->saveUserData($data);
    } catch (Exception $e) {
      $result = [
        'status' => Response::HTTP_UNAUTHORIZED,
        'error' => json_decode($e->getMessage())
      ];
    }

    return response()->json($result, $result['status']);
  }

  public function logOut(){
    $result = ['status' => Response::HTTP_OK];

    try {
      $result['message'] = $this->userService->logOut();
    } catch (Exception $e) {
      $result = [
        'status' => Response::HTTP_BAD_REQUEST,
        'error' => $e->getMessage()
      ];
    }
    return response()->json($result, $result['status']);
  }
}
