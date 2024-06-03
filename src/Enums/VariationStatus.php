<?php

namespace Callmeaf\Variation\Enums;

enum VariationStatus: int
{
    case PAYED = 1;
    case CANCELED = 2;
    case PENDING = 3;
    case PRODUCT = 4;

}
