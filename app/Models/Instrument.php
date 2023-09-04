<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;
    
    public function user_profiles(){
        return $this -> belongsToMany(UserProfile::class)->withPivot('user_profile_id');
    }
    
    public function recruitments() {
        return $this-> belongsToMany(Recruitment::class);
    }
    
    public function instruments() {
        return $this-> hasMany(Application::class);
    }
    
    public function getUserInstrumentId(UserProfile $user) {
        $user -> GetUserInfo();
        return $this -> Instrument::wherePivot('user_profile_id', $user->id)->get();
    }
    
    public function getInstidsInArray () {
        return $this-> query()
                    -> select('id')
                    -> get()
                    -> toArray();   //本当はarray_columnまで処理しておきたいが、$thisの再定義が不可能なのでコントローラーで処理
    }
    
}
