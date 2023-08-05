<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;

class UserController extends Controller
{
    public function create() {
        $user = \Auth::user();
        return view('user.create')->with(['user'=>$user]);
    }
    
    public function store(Request $request, UserProfile $prof) {
        $input = $request['edituser'];
        $prof -> fill($input) -> save();
        return redirect('/menu/top');
    }
}
