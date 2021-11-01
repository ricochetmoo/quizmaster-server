<?php
namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
	public function showAll()
	{
		return response()->json(Question::all());
	}

	public function showByQuiz($id)
	{
		return response()->json(Question::where('quiz', $id));
	}

	public function show($id)
	{
		return response()->json(Question::find($id));
	}

	public function create(Request $request)
	{
		$question = Question::create($request->all());

		return response()->json($question, 201);
	}

	public function update(Request $request, $id)
	{
		$question = Question::findOrFail($id);
		$question->update($request->all());

		return response()->json($question, 200);
	}

	public function delete($id)
	{
		Question::findOrFail($id)->delete();

		return response('Deleted successfully', 200);
	}
}