<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('admin.panel');
        }
        return back()->withErrors(['auth' => 'Wrong username or password']);
    }

    public function panel()
    {
        $context = [
            'categories' => Category::all(),
            'products' => ProductService::findAll(),
            'title' => 'Admin Panel'
        ];
        return view('admin.panel', $context);
    }
}
