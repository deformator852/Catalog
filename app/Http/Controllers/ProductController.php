<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $imagePath = $request->file('image')->store('products', 'public');
        $validated['image'] = $imagePath;
        ProductService::create($validated);
        return redirect()->route('admin.panel');
    }

    public function destroy(Product $product)
    {
        ProductService::delete($product);
        return response('');
    }
}
