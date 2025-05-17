<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public static function create(array $data): void
    {
        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'];
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
