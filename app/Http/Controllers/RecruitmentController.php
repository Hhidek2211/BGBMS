<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecruitRequest;
use App\Models\Recruitment;
use App\Models\Instrument;
use App\Models\UserProfile;
use App\Models\BandProfile;
use App\Http\Requests\AppRequest;

class RecruitmentController extends Controller
{
    public function create(BandProfile $band, Instrument $instruments) {
        return view('recruitment.create')-> with(['band'=> $band, 'instruments'=> $instruments-> get()]);
    }
    
    public function store(RecruitRequest $request ,Recruitment $recruit, BandProfile $band) {
        $input_string = $request['createrecruit'];  //フォーム入力内容の取得
        $input_inst = $request['recruitinst'];
    
        $recruit-> fill($input_string)->save();     //文章および募集楽器の保存
        $recruit-> instruments()-> attach($input_inst);
        
        $recruitid = $recruit->id;  //募集を作成したバンドのidを取得、該当idを持つレコードのrecruitment_idを上書き
        $band-> recruitment_id = $recruitid;
        $band-> save();
        return redirect('/menu/top');
    }
    
    public function list() {
        $bands = BandProfile::with('recruitment')-> whereNotNull('recruitment_id')-> get();
        //dd($bands);
        //$recruit = $band-> recruitment()->first();
        //dd($band, $recruit);
        //dd($recruit);
        return view('recruitment.list')->with(['bands'=> $bands]);
    }
    
    public function detail(Recruitment $recruit) {
        $insts = Recruitment::find($recruit->id)-> instruments()-> get();
        $band = BandProfile::where('recruitment_id', $recruit->id)-> first();
        //dd($inst, $band, $recruit);
        return view('recruitment.detail')->with(['insts'=>$insts, 'recruit'=> $recruit, 'band'=> $band]);
    }
    
    public function appform(Recruitment $recruit, UserProfile $user) {
        $userinfo = $user-> getUserInfo();      //コントローラーで使用するuserprofileのidを取得する(もうちょっとキレイにかけそうだなぁ)
        $userinsts = UserProfile::find($userinfo->id)-> instruments()-> get();  //ユーザーの保持する楽器レコード取得
        $band = BandProfile::where('recruitment_id', $recruit->id)-> first();
        $recruitinsts = Recruitment::find($recruit->id)-> instruments()->select('id')-> get()-> toArray();   
        $recruitinstids = array_column($recruitinsts, 'id');//募集している楽器idの取得
        
        //dd($userinstids, $recruitinstids);
        $matchinstids = array();    //募集-ユーザー間で共通する楽器検索
        foreach ($userinsts as $userinst) {
            if (in_array($userinst->id, $recruitinstids)) {
                $matchinsts[] = $userinst; 
            }    
        }
        
        //dd($user, $band, $recruit, $userinfo, $userinsts, $recruitinstids, $matchinsts); 
        return view('recruitment.appform')-> with(['user'=> $user-> getUserInfo(), 'band'=> $band, 'recruit'=> $recruit, 'insts'=>$matchinsts]);
    }
    
    public function application(Recruitment $recruit, AppRequest $request) {
        $input = $request['application'];
        $input += array('recruitment_id'=> $recruit->id);
        //dd($input);
        //$input_string =$request['application'];
        //dd($input_string);
        
        $recruit-> user_profiles()-> attach($input['user_profile_id'], ['message'=>$input['message'], 'instrument_id'=>$input['appinstid'] ]);
        return redirect('/menu/top'); 
    }
    
}

