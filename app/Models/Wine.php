<?php

namespace App\Models;

use App\Traits\HasImageUrl;
use App\Traits\HasSlug;
use App\Traits\WithCurrencyFormatted;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use NumberFormatter;

class Wine extends Model
{
    use HasSlug, HasImageUrl, WithCurrencyFormatted;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'year',
        'price',
        'stock',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function imageUrl(): Attribute
    {
        return $this->getImageUrl();
    }

    public function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->formatCurrency($this->price)
        );
    }
}
