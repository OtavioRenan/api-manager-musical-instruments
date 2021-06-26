<?php
declare(strict_types=1);

namespace App\Http\Requests;

class AutenticationRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userLogin' => ['required'],
            'userPassword' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'userLogin.required' => 'O campo login é obrigatório.',
            'userPassword.required' => 'O campo senha é obrigatório.'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 422)
        );
    }
}
