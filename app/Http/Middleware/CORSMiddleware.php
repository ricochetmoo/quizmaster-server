<?php
namespace App\Http\Middleware;

use Closure;

class CORSMiddleware
{
	public function handle($request, Closure $next)
	{
		$headers =
		[
			'Access-Control-Allow-Methods' => 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS',
			'Access-Control-Allow-Headers' => $request->header('Access-Control-Request-Headers'),
			'Access-Control-Allow-Origin' => '*'
		];
		
		if ($request->isMethod('OPTIONS'))
		{
			return response()->json('{"method":"OPTIONS"}', 200, $headers);
		}
		
		$response = $next($request);

		foreach($headers as $key => $value)
		{
			$response->header($key, $value);
		}

		return $response;
	}
}