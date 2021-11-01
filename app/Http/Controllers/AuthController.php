<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$this->validate
		(
			$request,
			[
				'name' => 'required|string',
				'email' => 'required|email|unique:users',
				'password' => 'required|confirmed'
			]
		);

		try
		{
			$user = new User;
			$user->name = $request->name;
			$user->email = $request->email;
			$plainPassword = $request->password;
			$user->password = app('hash')->make($plainPassword);

			$user->save();

			return response()->json($user, 201);
		}
		catch (\Exception $e)
		{
			return response('User registration failed.', 409);
		}
	}

	public function login(Request $request)
	{
		$this->validate
		(
			$request,
			[
				'email' => 'required|string',
				'password' => 'required|string'
			]
		);

		$credentials = $request->only(['email', 'password']);

		if (! $token = Auth::attempt($credentials))
		{
			return response('Unauthorized.', 401);
		}

		return $this->respondWithToken($token);
	}
}