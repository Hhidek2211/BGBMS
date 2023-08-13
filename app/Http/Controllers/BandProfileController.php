<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\BandProfile;
use App\Http\Requests\BandRequest;

class BandProfileController extends Controller
{
    public function create(UserProfile $user){
        return view("band.create")->with(['users'=>$user ->get()]);
    }
    
    public function store(BandRequest $request, BandProfile $prof){
        $input_prof = $request['editband'];
        $input_member = $request->bandmember;
        //dd($input_prof);
        foreach($input_member as $key => $value)   //未入力値の削除
            if($value == ""){
                unset($input_member[$key]);
            }
        
        $prof->fill($input_prof)->save();
        $prof->user_profiles()->attach($input_member);
        return redirect("/menu/top");
    }
    
    public function bandpage(BandProfile $band) {
        return view("band.bandpage")->with([ 'band'=>$band ]);
    }
    
}
