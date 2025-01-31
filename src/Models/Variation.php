<?php

namespace Callmeaf\Variation\Models;

use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasMediaMethod;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Variation\Enums\VariationNature;
use Callmeaf\Variation\Enums\VariationStatus;
use Callmeaf\Variation\Enums\VariationTypeCat;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Variation extends Model implements HasResponseTitles,HasEnum,HasMedia
{
    use HasDate,HasStatus,HasType,InteractsWithMedia,HasMediaMethod;
    protected $fillable = [
        'product_id',
        'variation_type_id',
        'status',
        'nature',
        'sku',
        'stock',
        'price',
        'discount_price',
        'title',
        'content',
    ];

    protected $casts = [
        'status' => VariationStatus::class,
        'nature' => VariationNature::class,
    ];

    protected static function booted(): void
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

    public function type(): BelongsTo
    {
        return $this->belongsTo(config('callmeaf-variation-type.model'),'variation_type_id');
    }

    public function priceText(): Attribute
    {
        return Attribute::get(
            fn() => currencyFormat(value: $this->price,locale: $this->product?->locale),
        );
    }

    public function discountPriceText(): Attribute
    {
        return Attribute::get(
            fn() => currencyFormat(value: $this->discount_price),
        );
    }

    public function realPrice(): Attribute
    {
        return Attribute::get(
            fn() => $this->discount_price ?? $this->price,
        );
    }

    public function isDigital(): bool
    {
        return $this->type?->cat === VariationTypeCat::DIGITAL;
    }

    public function isPhysical(): bool
    {
        return $this->type?->cat === VariationTypeCat::PHYSICAL;
    }

    public function hasStock(int $total = 1): bool
    {
        if(is_null($this->stock)) {
            return true;
        }
        return intval($this->stock) >= $total;
    }

    public function isEmpty(int $total = 1): bool
    {
        return !$this->hasStock($total);
    }

    public function responseTitles(ResponseTitle|string $key,string $default = ''): string
    {
        return [
            'store' => $this->title ?? $default,
            'update' => $this->title ?? $default,
            'status_update' => $this->title ?? $default,
            'destroy' => $this->title ?? $default,
            'restore' => $this->title ?? $default,
            'force_destroy' => $this->title ?? $default,
        ][$key instanceof ResponseTitle ? $key->value : $key];
    }

    public static function enumsLang(): array
    {
        return __('callmeaf-variation::enums');
    }
}
