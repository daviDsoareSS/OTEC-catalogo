<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
            'title' => 'required|string|max:200',
            'telephone' => 'required|string',
        ];
    }

    public function messages()
    {
        return[
            'title.required' => 'O campo de nome é obrigatório',
            'telephone.required' => 'O campo de telefone é obrigatório',
        ];
    }
}
