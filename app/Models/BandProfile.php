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
        
    public function getuserband($user){
        return $this::with(['user_profiles' => function ($query) {
            $query->where('id', $user);
        }])->get(); 
    }
    
}
