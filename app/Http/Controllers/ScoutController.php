<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\BandProfile;
use App\Models\Instrument;
use App\Models\Scout;
use App\Http\Requests\ScoutRequest;

class ScoutController extends Controller
{
//＜スカウト対象の選択に関わる処理＞
    //スカウトするユーザーの選択=> ユーザー一覧の表示
    public function select(BandProfile $band, Instrument $inst) {
        $usersbyinst = UserProfile::first()-> getByInstrument($band);  //各楽器を登録しているユーザーの一覧
        $loopinstid = session('loopinstid');
        
        if(isset($loopinstid)) {} else {    //初回のみのloopinstidの初期化処理
            $loopinstid = 1;
        }
        //dump($loopinstid);
        return view('scout.select')-> with(['usersbyinst'=> $usersbyinst, 'band'=> $band, 'insts'=> $inst->get(), 'loopinstid'=> $loopinstid]);
    }
    
    //表示するユーザーを変更する（表示する対象の楽器を変更する）ためのリロード処理
    public function reload(BandProfile $band, Request $request) {
        $loopinstid = (int) $request->loopinstid;
        session(['loopinstid'=> $loopinstid]);  //withメソッドが機能しないのでセッションで実装。挙動は意図通りなんだがwithじゃダメだった理由は謎。
        
        //dump($loopinstid);
        return redirect()-> route('scout_userselect', ['band'=> $band->id])-> with(['loopinstid'=> $loopinstid]);
    }
    
    //選んだユーザーの詳細表示
    public function detail(BandProfile $band, UserProfile $user) {
        $user = $user-> with('instruments')-> find($user->id);
        //dd($user);
        return view('scout.detail')-> with(compact('band', 'user'));
    }
    
//＜スカウトの作成に関わる処理＞
    //スカウト要項の入力ページ
    public function create(BandProfile $band, UserProfile $user) {
        $user = $user-> with('instruments')-> find($user->id);
        return view('scout.create')-> with(compact('band', 'user'));
    }
    
    //要項をscoutsテーブルに保存
    public function store(BandProfile $band, UserProfile $user, Scout $scout, ScoutRequest $request) {
        $input = $request['scout'];
        $input['user_profile_id'] = $user->id;
        $input['band_profile_id'] = $band->id;
        $input['instrument_id'] = (int)$input['instrument_id'];
        //dump($input);
        $scout-> fill($input)-> save();
        return redirect()-> route('top');
    }
}
