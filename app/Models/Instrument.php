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
        return $this-> belongsTo(Recruitment::class);
    }
    
    public function GetUserInstrumentId(UserProfile $user) {
        $user -> GetUserInfo();
        return $this -> Instrument::wherePivot('user_profile_id', $user->id)->get();
    }
    
}
