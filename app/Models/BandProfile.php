<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BandProfile extends Model
{
    use HasFactory;
    
    public function user_profiles(){        //バンド作成関連
        return $this -> belongsToMany(UserProfile::class)->withPivot('user_profile_id');
    }
    
    public function recruitment(){
        return $this-> belongsTo(Recruitment::class);
    }
    
    protected $fillable = [
        'name',
        'introduction',
        ];
        
    public function sortRecruitBands () {
        $user = UserProfile::first()-> getUserInfo();
        //d($user);
        return $this-> with('recruitment')
                    -> whereNotNull('recruitment_id')
                    -> whereHas('user_profiles', function($q) use($user) {
                        $q-> where('id', '!=', $user->id);
                    })
                    -> get();
    }
    
}
