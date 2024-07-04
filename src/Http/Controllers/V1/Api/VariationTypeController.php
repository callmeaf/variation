<?php

namespace Callmeaf\Variation\Http\Controllers\V1\Api;

use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Variation\Enums\VariationTypeStatus;
use Callmeaf\Variation\Events\VariationTypeDestroyed;
use Callmeaf\Variation\Events\VariationTypeIndexed;
use Callmeaf\Variation\Events\VariationTypeShowed;
use Callmeaf\Variation\Events\VariationTypeStatusUpdated;
use Callmeaf\Variation\Events\VariationTypeStored;
use Callmeaf\Variation\Events\VariationTypeUpdated;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationTypeDestroyRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationTypeIndexRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationTypeShowRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationTypeStatusUpdateRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationTypeStoreRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationTypeUpdateRequest;
use Callmeaf\Variation\Models\VariationType;
use Callmeaf\Variation\Services\V1\VariationTypeService;
use Callmeaf\Product\Services\V1\ProductService;
use Illuminate\Support\Facades\Log;

class VariationTypeController extends ApiController
{
    protected VariationTypeService $variationTypeService;
    public function __construct()
    {
        app(config('callmeaf-variation-type.middlewares.variation_type'))($this);
        $this->variationTypeService = app(config('callmeaf-variation-type.service'));
    }

    public function index(VariationTypeIndexRequest $request)
    {
        try {
            $variationTypes = $this->variationTypeService->all(
                relations: config('callmeaf-variation-type.resources.index.relations'),
                columns: config('callmeaf-variation-type.resources.index.columns'),
                filters: $request->validated(),
                events: [
                    VariationTypeIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-variation-type.resources.index.attributes'));
            return apiResponse([
                'variation_types' => $variationTypes,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function store(VariationTypeStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $variationType = $this->variationTypeService->create(data: $data,events: [
                VariationTypeStored::class
            ])->getModel(asResource: true,attributes: config('callmeaf-variation-type.resources.store.attributes'),relations: config('callmeaf-variation-type.resources.store.relations'));
            return apiResponse([
                'variation_type' => $variationType,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $variationType->responseTitles('store'),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(VariationTypeShowRequest $request,VariationType $variationType)
    {
        try {
            $variationType = $this->variationTypeService->setModel($variationType)->getModel(
                asResource: true,
                attributes: config('callmeaf-variation-type.resources.show.attributes'),
                relations: config('callmeaf-variation-type.resources.show.relations'),
                events: [
                    VariationTypeShowed::class,
                ],
            );
            return apiResponse([
                'variation_type' => $variationType,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function update(VariationTypeUpdateRequest $request,VariationType $variationType)
    {
        try {
            $data = $request->validated();
            $variationType = $this->variationTypeService->setModel($variationType)->update(data: $data,events: [
                VariationTypeUpdated::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-variation-type.resources.update.attributes'),relations: config('callmeaf-variation-type.resources.update.relations'));
            return apiResponse([
                'variation_type' => $variationType,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $variationType->responseTitles('update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function statusUpdate(VariationTypeStatusUpdateRequest $request,VariationType $variationType)
    {
        try {
            $variationType = $this->variationTypeService->setModel($variationType)->update([
                'status' => $request->get('status'),
            ],events: [
                VariationTypeStatusUpdated::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-variation-type.resources.status_update.attributes'),relations: config('callmeaf-variation-type.resources.status_update.relations'));
            return apiResponse([
                'variation_type' => $variationType,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $variationType->responseTitles('status_update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function destroy(VariationTypeDestroyRequest $request,VariationType $variationType)
    {
        try {
            $variationType = $this->variationTypeService->setModel($variationType)->getModel(asResource: true,attributes: config('callmeaf-variation-type.resources.destroy.attributes'),events: [
                VariationTypeDestroyed::class,
            ]);
            return apiResponse([
                'variation_type' => $variationType,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $variationType->responseTitles('destroy')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

}
