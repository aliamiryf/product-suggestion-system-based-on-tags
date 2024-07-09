<?php

namespace App\Lib\Classes\Services\v1\Suggestion;

use App\Lib\Classes\Services\BaseService;
use App\Lib\Interfaces\SuggestionServiceInterface;
use App\Models\Product;

class SuggestionService extends BaseService implements SuggestionServiceInterface
{

    public function getSuggestionProduct($product_id)
    {
        $product = Product::find($product_id)->load(['tags', 'tags.products', 'tags.products.categories', 'tags.products.tags', 'tags.products.active_price', 'tags.products.file']);
        $tags = $product->tags;
        $products = [];
        foreach ($tags as $tag) {
            foreach ($tag->products as $product) {
                if ($product->id != $product_id) {
                    $products[] = $product;
                }
            }
        }
        return $products;
    }
}
