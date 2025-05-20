<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $image       Path to the product image
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Product extends Model
{
	/**
	 * @return BelongsTo<Category, Product>
	 */
	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	protected static function booted(): void
	{
		static::deleting(function (Product $product) {
			Storage::disk('public')->delete($product->image);
		});
	}
}
