<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        $category = $request->query('category');
        $priceMin = $request->query('price_min');
        $priceMax = $request->query('price_max');
        $products = ProductService::findAll($category, $priceMin, $priceMax);
        Log::channel('stderr', 'asdaaasdsdkmadskadskasd');
        return response($products);
    }

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
