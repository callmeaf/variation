<?php

namespace Callmeaf\Variation\Utilities\V1\Api\VariationType;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class VariationTypeControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(): array
    {
        return [
            new Middleware(middleware: 'auth:sanctum',except: [
                'index'
            ])
        ];
    }
}
