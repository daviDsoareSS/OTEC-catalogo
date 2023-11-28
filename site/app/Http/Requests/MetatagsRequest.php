<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetatagsRequest extends FormRequest
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
            'pagina' => 'required',
            'descricao' => 'required',
            'keywords' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'finalidade.required' => 'O campo de finalidade é obrigatório',
            'tipo.required' => 'O campo de tipo é obrigatório',
            'content.required' => 'O campo do conteúdo é obrigatório',
        ];
    }
}
