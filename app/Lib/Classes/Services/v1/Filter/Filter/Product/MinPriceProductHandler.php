<?php

namespace App\Lib\Classes\Services\v1\Filter\Filter\Product;

class MinPriceProductHandler
{
    public function run($query, $filters)
    {
        return $query->whereHas('active_price', function ($query) use ($filters) {
            $query->where('amount', '>=', $filters['min_price']);
        });
    }
}
