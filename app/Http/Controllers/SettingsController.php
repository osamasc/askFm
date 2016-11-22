<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\About;

class SettingsController extends Controller
{   
    public function __construct()
    {
        return $this->middleware('auth');

        $currentAuth = Auth::user();
        view()->share(['currentAuth'=> $currentAuth ]);

    }

    public function getIndex()
    {   
        $user = Auth::User();
        return view('settings.home', compact('user'));
    }

    public function postSettings(Request $request)
    {
        $this->validateSettings($request);
        
        $user = Auth::User();
        $user->fullname = $request->fullname;
        $user->gender   = $request->gender;
        $user->update();

        $about = About::firstOrCreate(['user_id' => $user->id]);
        
        $about->location = $request->location;
        $about->bio      = $request->bio;
        $about->web      = $request->web;
        $about->update();


        return redirect()->back();
    }

    public function validateSettings($request)
    {
        $this->validate($request, [
    
            'fullname' => 'required|min:3|max:20',
            'gender'   => 'required',
            'location' => 'max:255',
            'bio'      => 'max:255',
            'web'      => 'max:255'
        ]);
    }

    public function setPic(Request $request)
    {
        $this->validate($request, [
            'type'  => 'required'
        ]);

        $type = $request->type;

        if ($type == 'profile-pic')
        {   
           $photo      = $request->file('image');
           $photoName  = time() . $photo->getClientOriginalName();
           $path       ='uploads/images/profile';
           $photo->move($path, $photoName);
       
           $user = Auth::user();
           $user->photo = $photoName;
           $user->update();

           return redirect()->back();

        } 

        else if ($type == 'cover-pic')
        {   
           $photo      = $request->file('image');
           $photoName  = time() . $photo->getClientOriginalName();
           $path       ='uploads/images/cover';
           $photo->move($path, $photoName);
       
           $user = Auth::user();
           $user->cover = $photoName;
           $user->update();

           return redirect()->back();

        }

    }
}
