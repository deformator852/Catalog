<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
	public function list(Request $request): AnonymousResourceCollection
	{
		$category = $request->query('category');
		$priceMin = $request->query('price_min');
		$priceMax = $request->query('price_max');
		$products = ProductService::findAll($category, $priceMin, $priceMax);
		return ProductResource::collection($products);
	}

	public function store(StoreProductRequest $request): RedirectResponse
	{
		$validated = $request->validated();
		$imagePath = $request->file('image')->store('products', 'public');
		$validated['image'] = $imagePath;
		ProductService::create($validated);
		return redirect()->route('admin.panel');
	}

	public function destroy(Product $product): Response
	{
		ProductService::delete($product);
		return response()->noContent();
	}
}
