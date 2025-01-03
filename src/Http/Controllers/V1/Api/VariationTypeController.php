<?php

namespace Callmeaf\Variation\Http\Controllers\V1\Api;

use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
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
use Callmeaf\Variation\Utilities\V1\Api\VariationType\VariationTypeResources;

class VariationTypeController extends ApiController
{
    protected VariationTypeService $variationTypeService;
    protected VariationTypeResources $variationTypeResources;
    public function __construct()
    {
        $this->variationTypeService = app(config('callmeaf-variation-type.service'));
        $this->variationTypeResources = app(config('callmeaf-variation-type.resources.variation_type'));
    }

    public static function middleware(): array
    {
        return app(config('callmeaf-variation-type.middlewares.variation_type'))();
    }

    public function index(VariationTypeIndexRequest $request)
    {
        try {
            $resources = $this->variationTypeResources->index();
            $variationTypes = $this->variationTypeService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
                events: [
                    VariationTypeIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes());
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
            $resources = $this->variationTypeResources->store();
            $data = $request->validated();
            $variationType = $this->variationTypeService->create(data: $data,events: [
                VariationTypeStored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'variation_type' => $variationType,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $variationType->responseTitles(ResponseTitle::STORE),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(VariationTypeShowRequest $request,VariationType $variationType)
    {
        try {
            $resources = $this->variationTypeResources->show();
            $variationType = $this->variationTypeService->setModel($variationType)->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
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
            $resources = $this->variationTypeResources->update();
            $data = $request->validated();
            $variationType = $this->variationTypeService->setModel($variationType)->update(data: $data,events: [
                VariationTypeUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'variation_type' => $variationType,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $variationType->responseTitles(ResponseTitle::UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function statusUpdate(VariationTypeStatusUpdateRequest $request,VariationType $variationType)
    {
        try {
            $resources = $this->variationTypeResources->statusUpdate();
            $variationType = $this->variationTypeService->setModel($variationType)->update([
                'status' => $request->get('status'),
            ],events: [
                VariationTypeStatusUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'variation_type' => $variationType,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $variationType->responseTitles(ResponseTitle::STATUS_UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function destroy(VariationTypeDestroyRequest $request,VariationType $variationType)
    {
        try {
            $resources = $this->variationTypeResources->destroy();
            $variationType = $this->variationTypeService->setModel($variationType)->getModel(asResource: true,attributes: $resources->attributes(),events: [
                VariationTypeDestroyed::class,
            ]);
            return apiResponse([
                'variation_type' => $variationType,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $variationType->responseTitles(ResponseTitle::DESTROY)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

}
