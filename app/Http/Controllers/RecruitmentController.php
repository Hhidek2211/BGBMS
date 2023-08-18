<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecruitRequest;
use App\Models\Recruitment;
use App\Models\Instrument;
use App\Models\BandProfile;

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
}
