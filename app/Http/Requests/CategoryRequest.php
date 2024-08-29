<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $imageRules = 'sometimes|image|mimes:png,jpg,jpeg|max:2048';

        if ($this->isMethod('POST')) {
            $imageRules = 'required|image|mimes:png,jpg,jpeg|max:2048';
        }

        return [
            // 'name' => 'required|string|max:255',
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($this->route('category'))],
            'description' => 'required|string|max:2000',
            'image' => $imageRules,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede ser mayor de 255 caracteres.',
            'name.unique' => 'La categoría ya existe.',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede ser mayor de 2000 caracteres.',
            'image.image' => 'La imagen debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser una imagen de tipo PNG, JPG o JPEG.',
            'image.max' => 'La imagen no puede ser mayor de 2 MB.',
            'image.required' => 'La imagen es requerida.',
        ];
    }
}
