<?php

namespace App\Http\Requests;

use App\Enums\CodeStatusEnum;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|min:8|numeric',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'phone.required'       => 'Số điện thoại không được để trống',
            'phone.min'       => 'Số điện thoại không nhỏ hơn 8 số',
            'phone.numeric'       => 'Số điện thoại phải là số',
            'password.required'       => 'Mật khẩu không được để trống',
            'password.min'       => 'Mật khẩu không nhỏ hơn 6 ký tự',
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => CodeStatusEnum::ERROR,
            ],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
