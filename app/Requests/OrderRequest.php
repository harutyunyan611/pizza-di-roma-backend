<?php
  namespace App\Requests;

  use Illuminate\Contracts\Validation\Validator;
  use Illuminate\Foundation\Http\FormRequest;
  use Illuminate\Http\Exceptions\HttpResponseException;
  use Symfony\Component\HttpFoundation\Response;

  class OrderRequest extends FormRequest {
    public function rules() {
      return [
        'first_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'address' => 'required|string',
        'phone' => 'required|digits:8'
      ];
    }

    protected function failedValidation(Validator $validator) {
      throw new HttpResponseException(response()->json(['status' => Response::HTTP_BAD_REQUEST, 'error' => $validator->errors()], Response::HTTP_BAD_REQUEST));
    }
  }