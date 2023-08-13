<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;

class MenuController extends Controller
{
    public function top(UserProfile $user){
        $user = UserProfile::where('user_id', \Auth::user()->id)->first();
        //dd($user);
        return view('menu.top')->with(['user'=>$user]);
    }
}
