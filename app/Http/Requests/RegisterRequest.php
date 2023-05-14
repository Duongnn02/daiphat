<?php

namespace App\Http\Requests;

use App\Enums\CodeStatusEnum;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
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
            'phone' => 'required|unique:users,phone|min:8|numeric',
            'password' => 'required|min:6',
        ];
    }


    public function messages()
    {
        return [
            'phone.required'       => 'Số điện thoại không được để trống',
            'phone.unique'       => 'Số điện thoại đã tồn tại',
            'phone.min'       => 'Số điện thoại không nhỏ hơn 8 số',
            'phone.numberic'       => 'Số điện thoại phải là số',
            'password.required'       => 'Mật khẩu không được để trống',
            'password.min'       => 'mật khẩu không nhỏ hơn 6 ký tự',
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
