<?php

namespace Callmeaf\Variation\Models;

use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasMediaMethod;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Variation\Enums\VariationStatus;
use Callmeaf\Variation\Enums\VariationType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Variation extends Model implements HasResponseTitles,HasEnum,HasMedia
{
    use HasDate,HasStatus,HasType,InteractsWithMedia,HasMediaMethod;
    protected $fillable = [
        'product_id',
        'status',
        'type',
        'sku',
        'stock',
        'price',
        'discount_price',
        'title',
        'content',
    ];

    protected $casts = [
        'status' => VariationStatus::class,
        'type' => VariationType::class,
    ];

    protected static function booted()
    {
        static::creating(function(Model $model) {
            $model->forceFill([
                'sku' => $model->sku ?? app(config('callmeaf-variation.service'))->newSku(),
            ]);
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(config('callmeaf-product.model'));
    }

    public function priceText(): Attribute
    {
        return Attribute::get(
            fn() => currencyFormat(value: $this->price),
        );
    }

    public function discountPriceText(): Attribute
    {
        return Attribute::get(
            fn() => currencyFormat(value: $this->discount_price),
        );
    }

    public function responseTitles(string $key,string $default = ''): string
    {
        return [
            'store' => $this->title ?? $default,
            'update' => $this->title ?? $default,
            'status_update' => $this->title ?? $default,
            'destroy' => $this->title ?? $default,
            'restore' => $this->title ?? $default,
            'force_destroy' => $this->title ?? $default,
        ][$key];
    }

    public static function enumsLang(): array
    {
        return __('callmeaf-variation::enums');
    }
}
