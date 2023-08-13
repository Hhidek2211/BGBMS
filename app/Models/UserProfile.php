<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    
    public function user(){
        return $this -> belongsTo(user::class);
    }
    
    public function band_profiles(){
        return $this -> belongsToMany(BandProfile::class);
    }
    
    public function instruments(){
        return $this -> belongsToMany(Instrument::class);
    }
    
    public function GetUserInfo(){
        return $this -> where('user_id', \Auth::user()->id)->first();
    }
    
    protected $fillable = [
        'name',
        'grade',
        'introduction',
        'instrument',
        'user_id',
        ];
}
