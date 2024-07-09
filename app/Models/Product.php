<?php

namespace App\Models;

use App\Lib\Classes\Services\v1\Filter\Handler\ProductFilterService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function active_price()
    {
        return $this->hasMany(PriceProduct::class)->where('quantity', '>=', 0)->where('status', true)->orderBy('id', 'DESC');
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function scopefilter($query, $filter)
    {
        $filterHandler = new ProductFilterService();
        return $filterHandler->filters($query, $filter);
    }
}
