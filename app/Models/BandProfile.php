<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BandProfile extends Model
{
    use HasFactory;
    
    public function user_profiles(){
        return $this -> belongsToMany(user_profile::class);
    }
}
