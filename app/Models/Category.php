<?php

namespace App\Models;

use App\Services\UploadService;
use App\Traits\HasImageUrl;
use App\Traits\HasSlug;
use \Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasSlug, HasImageUrl;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    public function imageUrl(): Attribute
    {
        return $this->imageUrl();
    }
}

