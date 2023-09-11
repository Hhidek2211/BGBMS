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
    
    public function instrument() {
        return $this->belongsTo(Instrument::class);
    }
    
    protected $fillable = [
        'title',
        'message',
        'user_profile_id',
        'band_profile_id',
        'instrument_id',
        ];
}
