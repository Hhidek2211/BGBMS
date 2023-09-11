<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\BandProfile;
use App\Models\Recruitment;
use App\Models\Application;
use App\Http\Requests\BandRequest;

class BandProfileController extends Controller
{
//<バンド作成機能に関する処理>
    //バンド作成画面への変遷
    public function create(){
        $users = Userprofile::with('instruments')-> get();
        return view("band.create")->with(['users'=> $users]);
    }
    
    //バンド作成処理
    public function store(BandRequest $request, BandProfile $prof){
        $input_prof = $request['editband'];
        $input_member = $request-> bandmember;
        //dd($input_prof);
        dd($input_member);
        foreach($input_member as $key => $value)   //未入力値の削除
            if($value == ""){
                unset($input_member[$key]);
            }
            
        if(empty($input_member)) {} else {      //バンドメンバーを未登録なら保存しない、まずそもそもバリデーションではじくべきではある
        $prof-> fill($input_prof)-> save();
        $prof-> user_profiles()-> attach($input_member);
        }
        return redirect()-> route('top');
    }
    
//<バンドページからできる機能の処理>
    //バンドページへの移動
    public function bandpage(BandProfile $band) {
        return view("band.bandpage")->with(['band'=> $band]);
    }
    
    //バンドプロフィール編集機能への移動
    public function edit(BandProfile $band, UserProfile $user) {
        //dd($band);
        $member = BandProfile::find($band->id)-> user_profiles()-> get();
        //dd($member);
        return view("band.edit")-> with(['band'=> $band, 'members'=> $member, 'users'=> $user-> get()]);
    }
    
    //編集内容の保存
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
        return redirect()-> route('top');
    }
    
//<応募への承認機能についての処理>
    //応募一覧への移動
    public function applist(BandProfile $band) {     //recruitment機能の側面も持つ　募集に対する応募への返答 最終的に当テーブルの持つuser_profilesリレーションを使って値を挿入するためこちらに実装 
        $recruit = $band-> recruitment()-> first();
        $appinfos = $recruit-> applications()->with(['instrument','user_profile'])-> get();
        //dd($recruit, $appinfos);
        return view('band.applist')->with(['appinfos'=> $appinfos, 'band'=> $band]);
    }
    
    //応募の詳細画面
    public function appdetail(BandProfile $band, UserProfile $user) {   //applicationが固有idを持たないため、UserProfile経由でappinfoを取得する。
        $recruit = $band-> recruitment()-> first();
        $user = $user->with('instruments')->find($user->id);    //  メモ：定義済みインスタンスにリレーション先の情報を書き込むことが出来た例。findでできてしまった。さすがにlaravelが有能といわざるを得ない。
        $appinfo = Application::with('instrument')
                -> where('user_profile_id', $user->id)
                -> where('recruitment_id', $recruit->id)
                -> first();
        //dd($band,$user, $appinfo);
        return view('band.appdetail')->with(['band'=> $band, 'user'=> $user, 'appinfo'=> $appinfo]); 
    }
    
    //応募への承認およびメンバー追加処理
    public function approval(BandProfile $band, UserProfile $user) {
        $members = $band->user_profiles()->get();
        $band-> user_profiles()-> detach();
        //dd($band);  //このダンプを使うとメンバー情報を消せる（なぜかバグってsyntaxエラーになる）
        $band-> user_profiles()-> attach($user);  //ユーザーの追加処理 ここまでの処理ですでにメンバーとして登録済みのユーザーがここに来れない前提で組んでいるため要対策
        $band-> user_profiles()-> attach($members); //メモ：なぜか[]を使って一文で書こうとするとdatetimeformatでエラーを吐く。意味が分からない。
        //dd($band, $members);
        
        $recruit = $band-> recruitment()->first();
        $recruit-> user_profiles()-> detach($user->id); //応募の削除処理
        return redirect()->route('applist', ['band'=> $band->id]);  //処理成功未確認 とりあえず主な処理は成功したのでデバッグ中に確かめるべし
    }
    
}
