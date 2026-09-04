<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AppUpdateRequest extends FormRequest
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
            'name' => 'required',
            'image_id' => 'required',
            'version' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'O domínio é obrigatório.',
            'image_id' => 'A imagem do app é obrigatória.',
            'version.required' => 'A versão da imagme é obrigatória.'
        ];
    }
}
