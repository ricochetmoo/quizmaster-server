<?php
namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuestionController extends Controller
{
	public function showAll()
	{
		return response()->json(Question::all());
	}

	public function showByQuiz($id)
	{
		try
		{
			Quiz::findOrFail($id);
			return response()->json(Question::where('quiz', $id));
		}
		catch (ModelNotFoundException)
		{
			return response('Quiz not found.', 404);
		}
	}

	public function show($id)
	{
		return response()->json(Question::find($id));
	}

	public function create(Request $request)
	{
		try
		{
			Quiz::findOrFail($request->quiz);

			$question = Question::create($request->all());

			return response()->json($question, 201);
		}
		catch (ModelNotFoundException)
		{
			return response("Quiz identifier invalid.", 400);
		}
	}

	public function update(Request $request, $id)
	{
		try
		{
			if (isset($request->quiz))
			{
				Quiz::findOrFail($request->quiz);
			}

			$question->update($request->all());

			return response()->json($question, 200);
		}
		catch (ModelNotFoundException)
		{
			return response("Quiz identifier invalid.", 400);
		}
	}

	public function delete($id)
	{
		Question::findOrFail($id)->delete();

		return response('Deleted successfully', 200);
	}
}