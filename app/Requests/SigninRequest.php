<?php
  namespace App\Requests;

  use Illuminate\Contracts\Validation\Validator;
  use Illuminate\Foundation\Http\FormRequest;
  use Illuminate\Http\Exceptions\HttpResponseException;
  use Symfony\Component\HttpFoundation\Response;

  class SigninRequest extends FormRequest {

    public function rules(){
      return [
          'email' => 'required|email',
          'password' => 'required|string'
      ];
    }

    protected function failedValidation(Validator $validator) {
      throw new HttpResponseException(response()->json(['status' => Response::HTTP_BAD_REQUEST, 'error' => $validator->errors()], Response::HTTP_BAD_REQUEST));
    }
  }