<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
	public function index(): View
	{
		$context = [
			'title' => 'Home',
			'categories' => Category::all()
		];
		return view('home', $context);
	}
}
