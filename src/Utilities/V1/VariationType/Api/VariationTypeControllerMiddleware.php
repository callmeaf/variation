<?php

namespace Callmeaf\Variation\Utilities\V1\VariationType\Api;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;


class VariationTypeControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(BaseController $controller): void
    {
        $controller->middleware('auth:sanctum')->except(['index']);
    }
}
