<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
	public static function findAll(?string $category = null, ?string $minPrice = null, ?string $maxPrice = null): Collection
	{
		$query = Product::with('category');
		if (!is_null($category)) $query->where('category_id', $category);
		if (!is_null($minPrice)) $query->where('price', '>=', $minPrice);
		if (!is_null($maxPrice)) $query->where('price', '<=', $maxPrice);
		return $query->get();
	}

	/**
	 * @param array{
	 *   name: string,
	 *   price: float,
	 *   image: string,
	 *   category: int
	 * } $data
	 */
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
