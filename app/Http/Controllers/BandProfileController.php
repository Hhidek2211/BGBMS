<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\BandProfile;
use App\Models\Recruitment;
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
    
    public function edit(BandProfile $band, UserProfile $user) {
        //dd($band);
        $member = BandProfile::find($band->id)-> user_profiles()-> get();
        //dd($member);
        return view("band.edit")->with(['band'=> $band, 'members'=> $member, 'users'=> $user-> get()]);
    }
    
    public function update(BandRequest $request, BandProfile $band) {
        $update_prof = $request['editband'];
        $update_member = $request->bandmember;
        
        foreach($update_member as $key => $value)   //未入力値の削除
            if($value == ""){
                unset($update_member[$key]);
            }
        
        $band-> fill($update_prof)-> save();
        $band-> user_profiles()-> detach();
        $band-> user_profiles()-> attach($update_member);
        return redirect("/menu/top");
    }
    
    public function applist(BandProfile $band) {     //recruitment機能の側面も持つ　募集に対する応募への返答 最終的に当テーブルの持つuser_profilesリレーションを使って値を挿入するためこちらに実装 
        $recruit = $band-> recruitment()-> first();
        $appinfos = $recruit-> applications()->with(['instrument','user_profile'])-> get();
        //dd($recruit, $appinfos);
        return view('band.applist')->with(['recruit'=> $recruit, 'appinfos'=> $appinfos, 'band'=> $band]);
    }
    
}
