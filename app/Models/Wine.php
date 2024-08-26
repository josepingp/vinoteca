<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use NumberFormatter;

class Wine extends Model
{
    use HasSlug;

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

    public function formattedPrice(): Attribute
    {
        $formatter = new NumberFormatter('es_ES', NumberFormatter::CURRENCY);

        return Attribute::make(
            get: fn() => $formatter->formatCurrency($this->price, 'EUR'),
        );

    }
}
