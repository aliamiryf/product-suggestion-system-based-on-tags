<?php

namespace App\Lib\Classes\Services\v1\Product;

use App\Lib\Classes\Services\BaseService;
use App\Lib\Interfaces\ProductServiceInterface;
use App\Models\Product;

class ProductService extends BaseService implements ProductServiceInterface
{


    public function __construct()
    {
        $this->setCollects(\App\Http\Resources\Product::class);
    }

    public function getAllProduct($filters = [])
    {
        return Product::with(['categories', 'tags', 'active_price', 'file'])->filter($filters)->get();
    }

    public function getProduct($id)
    {
        return Product::with(['categories', 'tags', 'active_price', 'file'])->findOrFail($id);
    }
}
