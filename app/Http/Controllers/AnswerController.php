<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Answer;

use App\Question;


class AnswerController extends Controller
{
    public function removeAnswer(Request $request)
    {
        $answer = Answer::where('question_id', $request->question_id)->first();
        $answer->delete();

        $question = Question::find($request->question_id);
        $question->replied = 0;
        $question->update();

        return redirect()->back();
    }
}
