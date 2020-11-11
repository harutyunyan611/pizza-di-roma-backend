<?php
  namespace App\Requests;

  use Illuminate\Contracts\Validation\Validator;
  use Illuminate\Foundation\Http\FormRequest;
  use Illuminate\Http\Exceptions\HttpResponseException;
  use Symfony\Component\HttpFoundation\Response;

  class SignupRequest extends FormRequest {

    public function rules(){
      return [
        'first_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'confirm_password' => 'required|same:password'
      ];
    }

    protected function failedValidation(Validator $validator) {
      throw new HttpResponseException(response()->json(['status' => Response::HTTP_BAD_REQUEST, 'error' => $validator->errors()], Response::HTTP_BAD_REQUEST));
    }
  }