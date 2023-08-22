<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruitment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function band_profile() {
        return $this-> hasOne(BandProfile::class); 
    }
    
    public function instruments() {
        return $this-> belongsToMany(Instrument::class);
    }
    
    public function user_profiles() {
        return $this-> belongsToMany(UserProfile::class, 'applications')->withPivot(['message', 'instrument_id'])->withTimestamps();
    }
    
    public function applications() {
        return $this-> hasMany(Application::class);
    }
    
    protected $fillable = [
        'title',
        'message',
        'deadline',
        ];
}
