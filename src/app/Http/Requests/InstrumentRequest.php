<?php
declare(strict_types=1);

namespace App\Http\Requests;

class InstrumentRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'slug' => ['required'],
            'description' => ['required'],
            // 'idInstrumentType' => ['required'],
            // 'idMode' => ['required'],
            // 'idMark' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'slug.required' => 'O campo slug é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.',
            'idInstrumentType.required' => 'O campo tipo de instrumento é obrigatório.',
            'idMode.required' => 'O campo modelo é obrigatório.',
            'idMark.required' => 'O campo marca é obrigatório.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], 422)
        );
    }
}
