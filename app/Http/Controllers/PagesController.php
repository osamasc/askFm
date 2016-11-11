<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Question;

use App\Answer;

use App\Relationship;


class PagesController extends Controller
{   

    public function __construct()
    {
        return $this->middleware('auth');
    }


    public function getUser($username)
    {
        $user  = User::where('username', $username)->first();
       
        $questions = Question::where('user_id', $user->id)->where('replied', 1)->get();
       
        $answerCount = Answer::where('user_id', $user->id)->count();

        $currentAuth = Auth::User();

        $followed  = Relationship::where('follower_id', Auth::user()->id)->where('followed_id', $user->id )->count();

        return view('pages.user', compact('user', 'questions', 'answerCount', 'currentAuth', 'followed'));
    }
}
