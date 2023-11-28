<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcompanheRequest extends FormRequest
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
            'subtitle' => 'required|string',
            'author' => 'required|string',
            'text' => 'required|string',
        ];
    }

    public function messages()
    {
        return[
            'title.required' => 'O campo de título é obrigatório',
            'subtitle.required' => 'O campo de resumo é obrigatório',
            'author.required' => 'O campo do autor é obrigatório',
            'text.required' => 'O campo do conteúdo é obrigatório',
        ];
    }
}
