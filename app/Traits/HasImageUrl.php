<?php

namespace App\Traits;
use App\Services\UploadService;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasImageUrl
{
    public function getImageUrl(): Attribute
    {
        return Attribute::make(
            fn() => UploadService::url($this->image),
        );
        ;
    }



}
