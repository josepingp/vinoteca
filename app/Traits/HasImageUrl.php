<?php

namespace App\Traits;
use App\Services\UploadService;
use Illuminate\Database\Eloquent\Model;


trait HasImageUrl
{
    public function ImageUrl(): string
    {
        return 'image';
    }

    public static function bootHasImageUrl(Model $model): void
    {
        static::getting()->each(function (Model $model) {
            $model->image = UploadService::url($model->image);
        });
    }


}
