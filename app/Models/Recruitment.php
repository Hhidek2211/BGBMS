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
    
    //Recruitment基準のsortRecruitBands(BandProfileのメソッド)
    public function sortIndicateRecords() {
        $user = UserProfile::first()-> getUserInfo();
        $userbands = $user-> band_profiles()-> select('id')-> get()-> toArray();
        $userbands = array_column($userbands, 'id');    //ユーザーが所属しているバンドを除外
        //dd($userbands);
        return $this-> with('band_profile')
                    -> whereHas('band_profile', function($q) use($userbands) {
                        $q-> whereNotIn('id', $userbands);
                    })
                    -> get();
    }
    
    public function sortIndicateRecordsWithLimit($limit) {
        $user = UserProfile::first()-> getUserInfo();
        $userbands = $user-> band_profiles()-> select('id')-> get()-> toArray();
        $userbands = array_column($userbands, 'id');    //ユーザーが所属しているバンドを除外
        //dd($userbands);
        return $this-> with('band_profile')
                    -> whereHas('band_profile', function($q) use($userbands) {
                        $q-> whereNotIn('id', $userbands);
                    })
                    -> limit($limit)
                    -> get();
    }
    
    protected $fillable = [
        'title',
        'message',
        'deadline',
        ];
}
