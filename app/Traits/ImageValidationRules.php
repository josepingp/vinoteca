<?php

namespace App\Traits;

trait ImageValidationRules
{

    public function imageRules(): string
    {
        if ($this->isMethod('POST')) {
            return 'required|image|mimes:png,jpg,jpeg,webp|max:2048';
        }
        return 'sometimes|image|mimes:png,jpg,jpeg,webp|max:2048';
    }
}
