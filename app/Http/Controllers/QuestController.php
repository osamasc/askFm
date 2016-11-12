<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Question;

use App\Answer;

use App\User;

use App\Notification;


class QuestController extends Controller
{   
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function postQuestion(Request $request)
    {
        $this->validateQuestion($request);


        $question = new Question();
        $question->content = $request->content;

        if (strlen($question->content) > 140){
            die('error');
        }
        $question->user_id = Auth::User()->id;
        $question->receiver_id = $request->receiver;


        if ($request->status === 'anonymously'){
            $question->anonymous = 1;
        }

        $question->save();

        $notification = new Notification();
        $notification->user_id = Auth::User()->id;
        $notification->receiver_id = $request->receiver;
        $notification->content= 'Asks You A Question';
        $notification->type = 'questions';
        $notification->question_id  = $question->id;
        $notification->save();


        return redirect()->back();
    }

    public function validateQuestion($request)
    {
        $this->validate($request, [
            'content'    =>  'required|max:255',
            'receiver' =>  'required',
        ]);
    }
   
    public function getQuestions()
    {
        $questions = Question::where('receiver_id', Auth::User()->id)->where('replied', 0)->get();
        $count     = Question::where('receiver_id', Auth::User()->id)->where('replied', 0)->count();
        return view('pages.questions', compact('questions', 'count'));
    }

    public function postDeleteQuestion(Request $request)
    {   

        $question = Question::find($request->id);

        if ($question->user_id != Auth::user()->id){ return 'Un autorized';}

        $question->delete();

        return redirect()->back();

    }

    public function getQuestion($id)
    {
        $question = Question::find($id);

            
        $replied  = $question->replied;
        $receiver = $question->receiver_id;

        if ( $replied == 0 & $receiver == Auth::user()->id){
            return view('pages.question', compact('question')); 
        }
        
        return redirect()->back();
    }

    public function postAnswer(Request $request)
    {   
        
        $question = Question::find($request->id);

        if ($question->receiver_id != Auth::user()->id){ return null;}

        $question->replied = 1;
        $question->update();


        $answer = new Answer();
        $answer->content = $request->answer;
        $answer->user_id = Auth::user()->id;
        $answer->question_id = $request->id;
        $answer->save();


        $notification = new Notification();
        $notification->user_id = Auth::User()->id;
        $notification->receiver_id = $question->user_id;
        $notification->content= 'Answerd Your Fuckn Question';
        $notification->type = 'Answers';
        $notification->question_id  = $question->id;
        $notification->answer_id    = $answer->id;
        $notification->save();

        
        return redirect('/account/questions');
    

    }

    public function singleQuestion($username)
    {
        $user = User::where('username', $username )->first();
        
        if (!$user){return 'this page is not found';}
        
        return view('pages.singleQuestion', compact('user'));
    }

}
