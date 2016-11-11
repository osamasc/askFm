<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Relationship;

use Illuminate\Support\Facades\Auth;

use App\User;


class FriendsController extends Controller
{
    public function getFriends()
    {
        $friends = Relationship::where('follower_id', Auth::user()->id)->get();

        return view('pages.friends', compact('friends'));
    }

    public function search(Request $request)
    {   
        $content = $request->content;
        // there is a problem here must be solved 
        //$friends = Relationship::where('follower_id', 'LIKE', '%'.$content.'%')->where('follower_id', Auth::user()->id)->get();

        $users = User::where('fullname', 'LIKE', '%'.$content.'%')->get();

        $back = '<table class="table">'; 

        foreach ($users as $user) {
            $back.= "<tr>
                        <td>{$user->fullname} (@{$user->username})</td>
                        <td><a href='#'>View</a></td>
                    </tr>";
        }

        $back.= "</table>";

        return $back;
    }
}
