<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DockerImageUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'path' => 'required|string',
            'tag' => 'required|string',
            'env_variables' => 'required|string'
        ];
    }

        public function messages(){
        return [
            'path.required' => 'A tag docker é obrigatória.',
            'tag.required' => 'A versão da tag é obrigatória.',
            'env_variables.required' => 'As variáveis de ambiente são obrigatórias.',
        ];
    }
}
