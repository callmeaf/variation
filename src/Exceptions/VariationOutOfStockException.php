<?php

namespace Callmeaf\Variation\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class VariationOutOfStockException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message ?: __('callmeaf-variation::v1.errors.out_of_stock',['title' => '']), $code ?: Response::HTTP_FORBIDDEN, $previous);
    }
}

