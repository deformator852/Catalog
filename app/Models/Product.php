<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id             Уникальный идентификатор продукта
 * @property string $name        Название продукта
 * @property float $price        Цена продукта (с точностью до 2 знаков после запятой)
 * @property string $image       Путь к изображению продукта
 * @property int $category_id    Внешний ключ категории, к которой относится продукт
 * @property string $description Описание продукта
 * @property Carbon|null $created_at Время создания записи
 * @property Carbon|null $updated_at Время последнего обновления записи
 */
class Product extends Model
{
    protected static function booted()
    {
        static::deleting(function (Product $product) {
            Storage::disk('public')->delete($product->image);
        });
    }
}
