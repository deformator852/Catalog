<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
	/**
	 *
	 * @param Closure(Request): (Response) $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		/** @var User|null $user */
		$user = Auth::user();
		if (!$user or !$user->is_admin) {
			abort(403, 'Access denied');
		}
		return $next($request);
	}
}
