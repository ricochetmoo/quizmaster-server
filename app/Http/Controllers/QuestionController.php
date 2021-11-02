<?php
namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuestionController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function showAll()
	{
		return response()->json(Question::all());
	}

	public function showByQuiz($id)
	{
		try
		{
			Quiz::findOrFail($id);
			return response()->json(Question::where('quiz', $id)->get());
		}
		catch (ModelNotFoundException $e)
		{
			return response('Quiz not found.', 404);
		}
	}

	public function showNextInQuiz($id)
	{
		$question = Question::findOrFail($id);
		
		$nextQuestion = Question::where('quiz', $question->quiz)->where('number', '>', $question->number)->orderBy('number', 'asc')->first();

		if (!$nextQuestion)
		{
			return response("No more questions in quiz.", 404);
		}

		return response()->json($nextQuestion);
	}

	public function showPreviousInQuiz($id)
	{
		$quesiton = Question::findOrFail($id);

		$previousQuesiton = Question::where('quiz', $question->quiz)->where('number', '<', $question->number)->orderBy('number', 'desc')->first();
		
		if (!$previousQuestion)
		{
			return response("This is the first question.", 404);
		}

		return response()->json($previousQuesiton);
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
		}
		catch (ModelNotFoundException $e)
		{
			return response("Quiz identifier invalid.", 400);
		}

		$question = new Question;
		$question->question = $request->question;
		$question->answer = $request->answer;
		$question->fact = $request->fact;
		
		if ($request->time)
		{
			$question->time = $request->time;
		}

		$question->quiz = $request->quiz;

		$previousQuestion = Question::where('quiz', $request->quiz)->orderBy('number', 'desc')->first();

		if ($previousQuestion)
		{
			$question->number = $previousQuestion->number +1;
		}
		else
		{
			$question->number = 1;
		}

		$question->save();

		return response()->json($question, 201);
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
		catch (ModelNotFoundException $e)
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