<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Relationship;

use Illuminate\Support\Facades\Auth;
    

class RelationsController extends Controller
{
    public function postFollow(Request $request)
    {   

        $validation = Relationship::where('follower_id', Auth::User()->id)->where('followed_id', $request->followed_id)->count();

        if ($request->is_followed == 0 ){

            if ($validation == 0){
                
                $relationship = new Relationship();
                $relationship->follower_id = Auth::User()->id;
                $relationship->followed_id = $request->followed_id;
                $relationship->save();                
            }

        }

        if ($request->is_followed == 1){

            if ($validation == 1 ){
                echo 'work on it';
                $relationship = Relationship::where('follower_id', Auth::User()->id)->where('followed_id', $request->followed_id)->first();
                $relationship->delete();

            }
        }

        
    }

}
