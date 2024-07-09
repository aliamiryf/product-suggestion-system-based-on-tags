<?php

namespace App\Lib\Classes\Services\v1\Filter\Filter\Product;

class MaxPriceProductHandler
{
    public function run($query, $filters)
    {
        return $query->whereHas('active_price', function ($query) use ($filters) {
            $query->where('amount', '<=', $filters['max_price']);
        });
    }
}
