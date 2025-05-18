<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $context = [
            'title' => 'Home',
            'products' => ProductService::findAll(),
            'categories' => Category::all()
        ];
        return view('home', $context);
    }
}
