<?php

namespace App\Traits;
use App\Services\UploadService;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasImageUrl
{
    public function ImageUrl(): Attribute
    {
        return Attribute::make(
            fn() => UploadService::url($this->image),
        );
        ;
    }



}
