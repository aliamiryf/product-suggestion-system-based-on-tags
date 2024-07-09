<?php

namespace App\Lib\Classes\Services\v1\Filter\Handler;


use App\Lib\Classes\Services\v1\Filter\Filter\NameFilterService;
use App\Lib\Classes\Services\v1\Filter\Filter\Product\MaxPriceProductHandler;
use App\Lib\Classes\Services\v1\Filter\Filter\Product\MinPriceProductHandler;

class ProductFilterService extends BaseFilterServices
{
    public function filters($query, $filters)
    {
        $this->filter = [
            'name' => NameFilterService::class,
            'min_price' => MinPriceProductHandler::class,
            'max_price' => MaxPriceProductHandler::class
        ];
        return $this->filtering($query, $filters);
    }
}
