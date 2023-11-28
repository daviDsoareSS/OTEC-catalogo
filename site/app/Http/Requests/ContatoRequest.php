<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
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
            'title' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|string',
            'text' => 'required|string',
        ];
    }
    public function messages()
    {
        return[
            'title.required' => 'O campo de título é obrigatório',
            'email.required' => 'O campo de e-mail é obrigatório',
            'telephone.required' => 'O campo do telefone é obrigatório',
            'text.required' => 'O campo do resumo é obrigatório',
        ];
    }
}
