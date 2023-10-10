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
        return redirect()-> route('top');
    }
    
    public function Recruitlist(Recruitment $recruit, BandProfile $band) {
        return view('recruitment.list')->with(['bands'=> $band-> sortRecruitBands(), 'insts'=> Instrument::get()]);  //$recruitsは募集の存在判定に利用
    }
    
    public function detail(Recruitment $recruit, UserProfile $user) {
        $insts = Recruitment::find($recruit->id)-> instruments()-> get();
        $band = BandProfile::where('recruitment_id', $recruit->id)-> first();
        $user = $user->getUserInfo();
        $matchInsts = $recruit->getInfoForAppform($recruit, $user);
        //dd($inst, $band, $recruit);
        return view('recruitment.detail')->with(['insts'=>$insts, 'recruit'=> $recruit, 'band'=> $band, 'user'=> $user, 'matchInsts'=> $matchInsts]);
    }
    
    public function application(Recruitment $recruit, AppRequest $request) {
        $input = $request['application'];
        $input += array('recruitment_id'=> $recruit->id);
        //dd($input);
        //$input_string =$request['application'];
        //dd($input_string);
        
        $recruit-> user_profiles()-> attach($input['user_profile_id'], ['message'=>$input['message'], 'instrument_id'=>$input['appinstid'] ]);
        return redirect()-> route('top'); 
    }
    
}

