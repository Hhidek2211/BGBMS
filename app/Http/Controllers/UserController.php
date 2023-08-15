<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\BandProfile;
use App\Models\Instrument;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function create(Instrument  $instrument) {
        $user = \Auth::user();
        return view('user.create')->with(['user'=>$user, 'instruments'=>$instrument -> get()]);     //質問点 getメソッドを[]の中にしなければいけない理由は何？
    }
    
    public function store(UserRequest $request, UserProfile $prof) {
        $input_user = $request['edituser'];
        $input_instrument = $request['instrument'];
        
        $prof -> fill($input_user) -> save();
        $prof -> instruments() -> attach($input_instrument);
        return redirect('/menu/top');
    }
    
    public function edit(UserProfile $user, Instrument $instrument) {
        //dd($userid);
        $inst = UserProfile::find($user->id)-> instruments()-> get();
        //dd(gettype($inst));
        $instid = array_column($inst->toArray(),'id');
        //dd($instid);
        return view('user.edit')->with(['user'=>$user, 'instruments'=>$instrument->get(), 'inst'=>$inst]);
    }
    
    public function update(UserUpdateRequest $request, UserProfile $user) {
        $update_user = $request['edituser'];
        $update_instrument = $request['instrument'];
        //dd($user);
        $user -> fill($update_user) -> save();
        //dd($prof);
        $user -> instruments() -> detach();
        $user -> instruments() -> attach($update_instrument);
        return redirect('/menu/top');
    }
    
    public function bandlist() {
        $userinfo = UserProfile::where('user_id', \Auth::user()->id)->first();
        //dd($userinfo);
        $userband = UserProfile::with('band_profiles')->find($userinfo->id);
        //dd($userband);
        return view('band.list')->with(['userbands' => $userband]);
    }
}
