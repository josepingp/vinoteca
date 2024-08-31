<?php

namespace App\Http\Requests;

use App\Traits\ImageValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WineRequest extends FormRequest
{
    use ImageValidationRules;

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
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => ['required', 'string', 'max:255', Rule::unique('wines', 'name')->ignore($this->route('wine'))],
            'description' => 'required|string|max:2000',
            'year' => ['required', 'integer', 'min:' . now()->subYears(100)->year, 'max:' . now()->year],
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => $this->imageRules(),
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede ser mayor de 255 caracteres.',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede ser mayor de 2000 caracteres.',
            'year.required' => 'El año es requerido.',
            'year.integer' => 'El año debe ser un número entero.',
            'price.required' => 'El precio es requerido.',
            'price.numeric' => 'El precio debe ser un número.',
            'stock.required' => 'El stock es requerido.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'image.image' => 'La imagen debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser una imagen de tipo PNG, JPG o JPEG.',
            'image.max' => 'La imagen no puede ser mayor de 2 MB.',
            'image.required' => 'La imagen es requerida.',
            'category_id.exists' => 'La categoría no existe.',
            'category_id.required' => 'La categoría es requerida.',
            'stock.min' => 'El stock debe ser mayor o igual a 0.',
            'price.min' => 'El precio debe ser mayor o igual a 0.',
            'year.min' => 'El año debe ser mayor o igual a ' . now()->subYears(100),
            'year.max' => 'El año debe ser menor o igual a ' . now()->year,
        ];
    }
}
