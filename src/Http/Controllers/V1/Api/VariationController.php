<?php

namespace Callmeaf\Variation\Http\Controllers\V1\Api;

use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Media\Enums\MediaCollection;
use Callmeaf\Media\Enums\MediaDisk;
use Callmeaf\Variation\Events\VariationDestroyed;
use Callmeaf\Variation\Events\VariationImageUpdated;
use Callmeaf\Variation\Events\VariationIndexed;
use Callmeaf\Variation\Events\VariationShowed;
use Callmeaf\Variation\Events\VariationStatusUpdated;
use Callmeaf\Variation\Events\VariationStored;
use Callmeaf\Variation\Events\VariationUpdated;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationDestroyRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationImageUpdateRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationIndexRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationShowRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationStatusUpdateRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationStoreRequest;
use Callmeaf\Variation\Http\Requests\V1\Api\VariationUpdateRequest;
use Callmeaf\Variation\Models\Variation;
use Callmeaf\Variation\Services\V1\VariationService;
use Callmeaf\Variation\Utilities\V1\Variation\Api\VariationResources;
use Illuminate\Support\Facades\Log;

class VariationController extends ApiController
{
    protected VariationService $variationService;
    protected VariationResources $variationResources;
    public function __construct()
    {
        app(config('callmeaf-variation.middlewares.variation'))($this);
        $this->variationService = app(config('callmeaf-variation.service'));
        $this->variationResources = app(config('callmeaf-variation.resources.variation'));
    }

    public function index(VariationIndexRequest $request)
    {
        try {
            $resources = $this->variationResources->index();
            $variations = $this->variationService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
                events: [
                    VariationIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes());
            return apiResponse([
                'variations' => $variations,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function store(VariationStoreRequest $request)
    {
        try {
            $resources = $this->variationResources->store();
            $data = $request->validated();
            $variation = $this->variationService->create(data: $data,events: [
                VariationStored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'variation' => $variation,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $variation->responseTitles('store'),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(VariationShowRequest $request,Variation $variation)
    {
        try {
            $resources = $this->variationResources->show();
            $variation = $this->variationService->setModel($variation)->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
                events: [
                    VariationShowed::class,
                ],
            );
            return apiResponse([
                'variation' => $variation,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function update(VariationUpdateRequest $request,Variation $variation)
    {
        try {
            $resources = $this->variationResources->update();
            $data = $request->validated();
            $variation = $this->variationService->setModel($variation)->update(data: $data,events: [
                VariationUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'variation' => $variation,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $variation->responseTitles('update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(VariationStatusUpdateRequest $request,Variation $variation)
    {
        try {
            $resources = $this->variationResources->statusUpdate();
            $variation = $this->variationService->setModel($variation)->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations(),events: [
                VariationStatusUpdated::class
            ]);
            return apiResponse([
                'variation' => $variation,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $variation->responseTitles('status_update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(VariationDestroyRequest $request,Variation $variation)
    {
        try {
            $resources = $this->variationResources->destroy();
            $variation = $this->variationService->setModel($variation)->delete()->getModel(asResource: true,attributes: $resources->attributes(),events: [
                VariationDestroyed::class,
            ]);
            return apiResponse([
                'variation' => $variation,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $variation->responseTitles('destroy',$variation->product->title)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function imageUpdate(VariationImageUpdateRequest $request,Variation $variation)
    {
        try {
            $resources = $this->variationResources->imageUpdate();
            $variation = $this->variationService->setModel($variation)->createMedia(file: $request->file('image'),collection: MediaCollection::IMAGE,disk: MediaDisk::VARIATIONS)->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations(),events: [
                VariationImageUpdated::class,
            ]);
             return apiResponse([
                 'variation' => $variation,
             ],__('callmeaf-base::v1.successful_updated_non_title'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


}
