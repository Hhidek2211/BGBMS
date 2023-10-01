<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BandProfile extends Model
{
    use HasFactory;
    
    public function user_profiles(){        //バンド作成関連
        return $this -> belongsToMany(UserProfile::class, 'members')->withPivot('user_profile_id');
    }
    
    public function recruitment(){
        return $this-> belongsTo(Recruitment::class);
    }
    
    public function scouts () {
        return $this-> hasMany(Scout::class);
    }
    
    protected $fillable = [
        'name',
        'introduction',
        ];
        
    public function sortRecruitBands () {
        $user = UserProfile::first()-> getUserInfo();
        $userbands = $user-> band_profiles()-> select('id')-> get()-> toArray();
        $userbands = array_column($userbands, 'id');    //ユーザーが所属しているバンドを除外
        //dd($userbands);
        return $this-> with('recruitment')
                    -> whereNotNull('recruitment_id')
                    -> whereNotIn('id', $userbands)
                    -> get();
    }
}
