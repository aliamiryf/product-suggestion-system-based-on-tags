<?php

namespace App\Lib\Classes\Services\v1\Filter\Handler;

class BaseFilterServices
{
    public $filter;

    public function __construct($filter = [])
    {
        $this->filter = $filter;
    }

    public function filtering($query, $filters)
    {
        foreach ($filters as $key => $filter) {
            if (isset($this->filter[$key])) {
                $filterHandler = new ($this->filter[$key]);
                if (isset($filterHandler)) {
                    $filterHandler->run($query, $filters);
                }
            }
        }
        return null;
    }
}
