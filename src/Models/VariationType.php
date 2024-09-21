<?php

namespace Callmeaf\Variation\Models;

use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Base\Traits\Localeable;
use Callmeaf\Variation\Enums\VariationTypeCat;
use Callmeaf\Variation\Enums\VariationTypeStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class VariationType extends Model implements HasResponseTitles,HasEnum
{
    use HasDate,HasStatus,HasType,Localeable;
    protected $fillable = [
        'status',
        'cat',
        'title',
        'content',
    ];

    protected $casts = [
        'status' => VariationTypeStatus::class,
        'cat' => VariationTypeCat::class,
    ];

    public function catText(): Attribute
    {
        return Attribute::get(
            fn() => enumTranslator(enumCase: $this->cat,languages: $this->enumsLang())
        );
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
