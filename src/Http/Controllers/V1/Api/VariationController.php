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
use Illuminate\Support\Facades\Log;

class VariationController extends ApiController
{
    protected VariationService $variationService;
    public function __construct()
    {
        app(config('callmeaf-variation.middlewares.variation'))($this);
        $this->variationService = app(config('callmeaf-variation.service'));
    }

    public function index(VariationIndexRequest $request)
    {
        try {
            $variations = $this->variationService->all(
                relations: config('callmeaf-variation.resources.index.relations'),
                columns: config('callmeaf-variation.resources.index.columns'),
                filters: $request->validated(),
                events: [
                    VariationIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-variation.resources.index.attributes'));
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
            $data = $request->validated();
            $variation = $this->variationService->create(data: $data,events: [
                VariationStored::class
            ])->getModel(asResource: true,attributes: config('callmeaf-variation.resources.store.attributes'),relations: config('callmeaf-variation.resources.store.relations'));
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
            $variation = $this->variationService->setModel($variation)->getModel(
                asResource: true,
                attributes: config('callmeaf-variation.resources.show.attributes'),
                relations: config('callmeaf-variation.resources.show.relations'),
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
            $data = $request->validated();
            $variation = $this->variationService->setModel($variation)->update(data: $data,events: [
                VariationUpdated::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-variation.resources.update.attributes'),relations: config('callmeaf-variation.resources.update.relations'));
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
            $variation = $this->variationService->setModel($variation)->getModel(asResource: true,attributes: config('callmeaf-variation.resources.status_update.attributes'),relations: config('callmeaf-variation.resources.status_update.relations'),events: [
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
            $variation = $this->variationService->setModel($variation)->delete()->getModel(asResource: true,attributes: config('callmeaf-variation.resources.destroy.attributes'),events: [
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
            $variation = $this->variationService->setModel($variation)->createMedia(file: $request->file('image'),collection: MediaCollection::IMAGE,disk: MediaDisk::VARIATIONS)->getModel(asResource: true,attributes: config('callmeaf-variation.resources.image_update.attributes'),relations: config('callmeaf-variation.resources.image_update.relations'),events: [
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
