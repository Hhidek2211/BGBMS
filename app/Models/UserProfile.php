<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    
//<リレーション定義>
    public function user(){
        return $this -> belongsTo(user::class);
    }
    
    public function band_profiles(){
        return $this -> belongsToMany(BandProfile::class);
    }
    
    public function instruments(){
        return $this -> belongsToMany(Instrument::class)->withPivot('user_profile_id');
    }
    
    public function recruitments() {
        return $this->belongsToMany(Recruitment::class, 'applications')->withPivot(['message', 'instrument_id']);
    }
    
    public function applications() {
        return $this->hasMany(Application::class);
    }
    
    public function scouts () {
        return $this-> hasMany(Scout::class);
    }
    
//<処理に利用するメソッド>
    //ログインユーザーと結びつくUserProfileのレコードを取得
    public function getUserInfo() {
        return $this-> where('user_id', \Auth::user()->id)-> first();
    }
    
    //全ユーザーを登録している楽器ごとに分け、楽器ごとに個別の配列に格納する
    public function getByInstrument ($band) {
        $instids = Instrument::first()-> getInstidsInArray();
        $instids = array_column($instids, 'id');        //instrumentsに存在するidを単純な配列で取得
        
        $memberid = $band-> user_profiles()     //検索の除外対象である操作中バンドのメンバーのidを取得
                 -> select('id')
                 -> get()
                 -> toArray();
        $memberid = array_column($memberid, 'id');
        //dd($memberid);
        $return[] = 0;  //instのidと取得配列の番号一致のため０番に空要素を挿入
        
        foreach ($instids as $instid) {     //配列変数$returnに6つのコレクションインスタンスを格納、各配列にidの一致する楽器を登録しているユーザーを登録
        $return[] = UserProfile::with('instruments')
                 -> wherehas('instruments', function($q) use($instid) {
                    $q-> where('id', $instid); })
                 -> whereNotIn('id', $memberid)     //うちバンドメンバーのみ除外
                 -> get();
        }
        return $return;
    }
    
    protected $fillable = [
        'name',
        'grade',
        'introduction',
        'instrument',
        'user_id',
        ];
}
