<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    
    public function user_profile() {
        return $this-> belongsTo(UserProfile::class);
    }
    
    public function recruitment() {
        return $this-> belongsTo(Recruitment::class);
    }
    
    public function instrument() {
        return $this-> belongsTo(Instrument::class);
    }
}
