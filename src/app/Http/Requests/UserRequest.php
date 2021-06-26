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
            'userName' => ['required'],
            'userLogin' => ['required', \Illuminate\Validation\Rule::unique('user', 'login')->ignore($this->user, 'id')],
            'userPassword' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'userName.required' => 'O campo nome é obrigatório.',
            'userLogin.required' => 'O campo login é obrigatório.',
            'userLogin.unique' => 'Já existe um usuário com este login.',
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
