<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Like;

use App\Answer;

use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function postLike(Request $request)
    {

        $answer = Answer::find($request->answer_id);

        if(!$answer){ return null;}

        $user = Auth::user();

        $like = $user->likes()->where('answer_id', $request->answer_id)->first();

        if ($request->isliked == 1)
        {
            if ($like){
                $action = Like::where('user_id', $user->id)->where('answer_id', $request->answer_id)->first();
                $action->delete();

            }
        }

        elseif ($request->isliked == 0)
        {
            
            if ($like) { return null;}

            $action = new Like();
            $action->user_id  = $user->id;
            $action->answer_id = $request->answer_id;
            $action->save();

        }
        return 'done';
    }


}
