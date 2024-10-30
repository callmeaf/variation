<?php

namespace Callmeaf\Variation\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
use Callmeaf\Variation\Exceptions\VariationOutOfStockException;
use Callmeaf\Variation\Models\Variation;
use Callmeaf\Variation\Services\V1\Contracts\VariationServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VariationService extends BaseService implements VariationServiceInterface
{
    public function __construct(?Builder $query = null, ?Model $model = null, ?Collection $collection = null, ?JsonResource $resource = null, ?ResourceCollection $resourceCollection = null, array $defaultData = [],?string $searcher = null)
    {
        parent::__construct($query, $model, $collection, $resource, $resourceCollection, $defaultData,$searcher);
        $this->query = app(config('callmeaf-variation.model'))->query();
        $this->resource = config('callmeaf-variation.model_resource');
        $this->resourceCollection = config('callmeaf-variation.model_resource_collection');
        $this->defaultData = config('callmeaf-variation.default_values');
        $this->searcher = config('callmeaf-variation.searcher');
    }

    public function newSku(): ?string
    {
        $sku = randomId(length: config('callmeaf-variation.sku_length'),prefix: config('callmeaf-variation.prefix_sku'));
        if(is_null($sku)) {
            return null;
        }
        if($this->freshQuery()->where(column: 'sku',valueOrOperation: $sku)->exists()) {
            return  $this->newSku();
        }
        return $sku;
    }

    public function decreaseStock(int $total = 1): VariationServiceInterface
    {
        /**
         * @var Variation $variation
         */
        $variation = $this->model;
        $stock = $variation->stock;
        if(is_null($stock)) {
            return $this;
        }
        if($variation->isEmpty($total)) {
            throw new VariationOutOfStockException(__('callmeaf-variation::v1.errors.out_of_stock', ['title' => $variation->title]));
        }
        $this->update([
            'stock' => $stock - $total,
        ]);

        return $this;
    }


    public function increaseStock(int $total = 1): VariationServiceInterface
    {
        return $this->decreaseStock(-$total);
    }

}
