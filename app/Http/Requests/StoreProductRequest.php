<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
{
	protected function failedAuthorization(): void
	{
		abort(403, 'Access denied');
	}

	public function authorize(): bool
	{
		return Auth::check() && Auth::user()->is_admin;
	}

	/**
	 * @return array<string, string>
	 */
	public function rules(): array
	{
		return [
			'name' => 'required|string|max:255',
			'price' => 'required|numeric|min:0',
			'image' => 'required|image|max:4028',
			'category' => 'required|integer|exists:categories,id'
		];
	}
}
