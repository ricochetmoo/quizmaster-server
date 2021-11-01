<?php
namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
	public function showAll()
	{
		return response()->json(Quiz::all());
	}
	
	public function showOne($id)
	{
		return response()->json(Quiz::find($id));
	}

	public function create(Request $request)
	{
		$quiz = Quiz::create($request->all());

		return response()->json($quiz, 201);
	}

	public function update(Request $request, $id)
	{
		$quiz = Quiz::findOrFail($id);
		$quiz->update($request->all());

		return response()->json($quiz, 200);
	}

	public function delete($id)
	{
		Quiz::findOrFail($id)->delete;

		return response('Deleted successfully.', 200);
	}
}