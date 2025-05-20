<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property-read int $id
 * @property-read string $name
 * @property-read float|int $price
 * @property-read string|null $image
 * @property-read ?Category $category
 */
class ProductResource extends JsonResource
{
	/**
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'price' => $this->price,
			'category' => [
				'id' => $this->category->id ?? null,
				'name' => $this->category->name ?? null,
			],
			'image' => $this->image
		];
	}
}
