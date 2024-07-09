<?php

namespace App\Http\Controllers;

use App\Lib\Interfaces\ProductServiceInterface;
use App\Lib\Interfaces\SuggestionServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    private $suggestionService;

    public function __construct(ProductServiceInterface $productService, SuggestionServiceInterface $suggestionService)
    {

        $this->suggestionServic = $suggestionService;
        $this->productService = $productService;
    }

    public function all(Request $request)
    {
        $products = $this->productService->getAllProduct($request->all());
        return $this->productService->resourceCollection($products, 'products', true);
    }

    public function get($id)
    {
        $product = $this->productService->getProduct($id);
        return $this->productService->resource($product, true, 'product');
    }

    public function suggestion($id)
    {
        $products = $this->suggestionServic->getSuggestionProduct($id);
        return $this->productService->resourceCollection($products, 'products', true);
    }
}
