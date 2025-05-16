<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:4028',
            'category' => 'required|integer|exists:categories,id'
        ]);
        $imagePath = $request->file('image')->store('products', 'public');
        $product = new Product();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->image = $imagePath;
        $product->category_id = $validated['category'];
        $product->save();
        return redirect()->route('admin.panel');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Log::channel('stderr')->info('Сообщениеasdadadadsadd');
        return response('');
    }
}
