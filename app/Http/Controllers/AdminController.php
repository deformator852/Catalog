<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
	public function login(Request $request): RedirectResponse
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

	public function panel(): View
	{
		$context = [
			'categories' => Category::all(),
			'products' => ProductService::findAll(),
			'title' => 'Admin Panel'
		];
		return view('admin.panel', $context);
	}
}
