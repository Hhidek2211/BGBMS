<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;
    
    public function band_profile() {
        return $this-> hasOne(BandProfile::class); 
    }
    
    public function instruments() {
        return $this-> belongsToMany(Instrument::class);
    }
    
    public function user_profiles() {
        return $this-> belongsToMany(UserProfile::class, 'applications')->withPivot(['message', 'appinstid'])->withTimestamps();
    }
    
    protected $fillable = [
        'title',
        'message',
        'deadline',
        ];
}
