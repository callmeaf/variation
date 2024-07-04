<?php

namespace Callmeaf\Variation\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
use Callmeaf\Variation\Services\V1\Contracts\VariationTypeServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VariationTypeService extends BaseService implements VariationTypeServiceInterface
{
    public function __construct(?Builder $query = null, ?Model $model = null, ?Collection $collection = null, ?JsonResource $resource = null, ?ResourceCollection $resourceCollection = null, array $defaultData = [],?string $searcher = null)
    {
        parent::__construct($query, $model, $collection, $resource, $resourceCollection, $defaultData,$searcher);
        $this->query = app(config('callmeaf-variation-type.model'))->query();
        $this->resource = config('callmeaf-variation-type.model_resource');
        $this->resourceCollection = config('callmeaf-variation-type.model_resource_collection');
        $this->defaultData = config('callmeaf-variation-type.default_values');
        $this->searcher = config('callmeaf-variation-type.searcher');
    }

}
