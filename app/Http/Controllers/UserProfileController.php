<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\BandProfile;
use App\Models\Instrument;
use App\Models\Scout;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;

class UserProfileController extends Controller
{
//<トップメニュー>
    //移動処理
    public function top(){
        $user = UserProfile::where('user_id', \Auth::user()->id)-> first();
        //dd($user);
        if(is_null($user)) {
            return redirect()-> route('usercreate');
        }
        return view('menu.top')-> with(['user'=> $user]);
    }
    
//<ユーザーに関する機能の処理>
    //ユーザー作成画面への移動
    public function create(Instrument  $instruments) {
        $user = \Auth::user();
        return view('user.create')-> with(['user'=> $user, 'instruments'=> $instruments-> get()]); 
    }
    
    //作成したユーザーの保存
    public function store(UserRequest $request, UserProfile $prof) {
        $input_user = $request['edituser'];
        $input_instrument = $request['instruments'];
        
        $prof-> fill($input_user)-> save();
        $prof-> instruments()-> attach($input_instrument);
        return redirect()-> route('top');
    }
    
    //ユーザープロフィール編集画面への移動
    public function edit(UserProfile $user, Instrument $instrument) {
        $userinsts = $user-> instruments()-> get();
        $userinstids = array_column($userinsts-> toArray(), 'id');
        //dd($instids);
        return view('user.edit')-> with(['user'=> $user, 'instruments'=> $instrument-> get(), 'userinstids'=> $userinstids]);
    }
    
    //編集内容の保存
    public function update(UserUpdateRequest $request, UserProfile $user) {
        $update_user = $request['edituser'];
        $update_instrument = $request['instrument'];
        //dd($user);
        $user-> fill($update_user)-> save();  //自テーブルカラムの上書き
        $user-> instruments()-> detach();     //中間テーブルの上書き処理
        $user-> instruments()-> attach($update_instrument);
        return redirect()-> route('top');
    }
    
    //自分のバンド一覧への移動
    public function bandlist(UserProfile $user) {
        $userbands = $user-> band_profiles()-> get();
        //dd($userbands);
        return view('band.list')-> with(['userbands'=> $userbands]);
    }
    
//<スカウト承認に関しての処理>
    //スカウト一覧の確認画面
    public function scoutlist(UserProfile $user) {
        $scouts = Scout::with('band_profile')-> where('user_profile_id', $user->id)-> get();
        return view('user.scoutlist')-> with(compact(['user', 'scouts']));
    }
    
    //個々のスカウトの詳細及び承認画面
    public function scoutdetail(UserProfile $user, Scout $scout) {
        $band = BandProfile::with('user_profiles')->find($scout->band_profile_id);
        //dd($scout);
        return view('user.scoutdetail')-> with(compact(['user', 'scout', 'band']));
    }
    
    //スカウト承認後のメンバー追加処理
    public function scoutapprove(UserProfile $user, Scout $scout) {
        $band = BandProfile::with('user_profiles')-> find($scout->band_profile_id);
        $members = $band-> user_profiles()-> select('id')-> get();
        //dd($member, $band);
        $band-> user_profiles()-> detach();
        $band-> user_profiles()-> attach($members);
        $band-> user_profiles()-> attach($user->id);
        $scout-> delete();      //承認したスカウトの削除
        return redirect()-> route('top');
    }
}
