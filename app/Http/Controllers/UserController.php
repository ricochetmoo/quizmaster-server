<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middlware('auth');
	}

	public function profile()
	{
		return response()->json(['user' => Auth::user()]);
	}

	public function showAll()
	{
		return response()->json(User::all());
	}

	public function showOne($id)
	{
		return response()->json(User::find($id));
	}
}