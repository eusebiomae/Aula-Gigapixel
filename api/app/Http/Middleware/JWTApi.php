<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTHelper;

class JWTApi
{
	/**
	* Handle an incoming request.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \Closure  $next
	* @return mixed
	*/
	public function handle(Request $request, Closure $next)
	{
		$gpToken = $request->headers->get('gp-token');

		if (empty($gpToken)) {
			return response()->json([
				'errors' => [
					'Token não informado',
				]
			], 401);
		}

		$jwtHelper = new JWTHelper;
		$jwtHelper->setGPToken($gpToken);

		if ($jwtHelper->isValid()) {
			$request['payload'] = $jwtHelper->getPayload();

			return $next($request);
		}

		return response()->json([
			'errors' => [
				'Token inválido',
			]
		], 401);
	}
}
