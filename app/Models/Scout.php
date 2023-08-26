<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scout extends Model
{
    use HasFactory;
    
    public function user_profile () {
        return $this-> belongsTo(UserProfile::class);
    }
    
    public function band_profile () {
        return $this-> belongsTo(BandProfile::class);
    }
}
