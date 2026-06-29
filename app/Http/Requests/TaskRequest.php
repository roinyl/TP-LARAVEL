<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ];
    }

    // message d'erreur personnaliser 
    public function messages(): array
    {
        return [
            'title.required' => 'le nom est obligatoire',
            'description.max' => 'la description est trop longue',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => ucwords(trim($this->title)), // met la premiere lettre de chaque mot en maj et retire les epsaces inutiles
            'description' => ucfirst(trim($this->description)), // met la premiere lettre en maj et retire les espaces inutiles
        ]);
    }
}
