<?php
declare(strict_types=1);

namespace App\Http\Requests;

class ModelYearRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'launch' => ['required', 'date'],
            'end' => ['date'],
        ];
    }

    public function messages()
    {
        return [
            'launch.required' => 'O campo início é obrigatório.',
            'launch.date' => 'O campo início deve ser uma data.',
            'end.date' => 'O campo fim deve ser uma data.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 422)
        );
    }
}
