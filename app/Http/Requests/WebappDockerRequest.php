<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class WebappDockerRequest extends FormRequest
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
            'docker_tag' => 'required|string',
            'tag_version' => 'required|string',
            'env_variables' => 'required|string'
        ];
    }

        public function messages(){
        return [
            'docker_tag.required' => 'A tag docker é obrigatória.',
            'tag_version.required' => 'A versão da tag é obrigatória.',
            'env_variables.required' => 'As variáveis de ambiente são obrigatórias.',
        ];
    }
}
