<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public static function findAll(?int $category = null, ?float $minPrice = null, ?float $maxPrice = null)
    {
        $query = Product::with('category');
        if (!is_null($category)) $query->where('category_id', $category);
        if (!is_null($minPrice)) $query->where('price', '>=', $minPrice);
        if (!is_null($maxPrice)) $query->where('price', '<=', $maxPrice);
        return $query->get();
    }

    public static function create(array $data): void
    {
        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->image = $data['image'];
        $product->category_id = $data['category'];
        $product->save();
    }

    public static function delete(Product $product): void
    {
        $product->delete();
    }
}
