<?php

namespace App\Lib\Classes\Services\v1\Filter\Filter;

class NameFilterService
{
    public function run($query, $filters)
    {
        return $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
    }
}
