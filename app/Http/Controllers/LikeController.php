<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Like;

use App\Answer;

use Illuminate\Support\Facades\Auth;

use App\Question;

use App\Notification;

class LikeController extends Controller
{
    public function postLike(Request $request)
    {

        $question = Question::find($request->question_id);
        
        $answer_id = $question->answer['id'];

        $test = Answer::find($answer_id);

        if(!$test){ return null;}

        $user = Auth::user();

        $like = $user->likes()->where('answer_id', $answer_id)->first();


        if ($request->isliked == 1)
        {
            if ($like){
                $action = Like::where('user_id', $user->id)->where('answer_id', $answer_id)->first();
                $action->delete();
            }
        }

        elseif ($request->isliked == 0)
        {
            
            if ($like) { return null;}

            // some process

            $action = new Like();
            $action->user_id  = $user->id;
            $action->answer_id = $answer_id;
            $action->save();


            $notification = new Notification();
            $notification->user_id = $user->id;
            $notification->receiver_id = $question->user_id;
            $notification->content= 'Likes Your Answer';
            $notification->type = 'likes';
            $notification->answer_id    = $answer_id;
            $notification->question_id  = $question->id;
            $notification->save();

        }
    }


}
