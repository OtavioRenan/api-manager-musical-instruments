<?php
declare(strict_types=1);

namespace App\Http\Requests;

class UserRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'login' => ['required', \Illuminate\Validation\Rule::unique('user', 'user_login')->ignore($this->user, 'user_id')],
            'password' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'login.required' => 'O campo login é obrigatório.',
            'login.unique' => 'Já existe um usuário com este login.',
            'password.required' => 'O campo senha é obrigatório.'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 422)
        );
    }
}
