<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id             Unique product identifier
 * @property string $name        Product name
 * @property float $price        Product price (with precision up to 2 decimal places)
 * @property string $image       Path to the product image
 * @property int $category_id    Foreign key of the category the product belongs to
 * @property Carbon|null $created_at Timestamp when the record was created
 * @property Carbon|null $updated_at Timestamp of the last record update
 */
class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        static::deleting(function (Product $product) {
            Storage::disk('public')->delete($product->image);
        });
    }
}
