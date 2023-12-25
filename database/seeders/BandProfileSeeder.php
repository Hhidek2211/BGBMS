<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BandProfile;
use App\Models\UserProfile;

class BandProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        /DB::table('band_profiles')->insert([
                'name' => 'テストバンド１',
                'introduction' => 'テストです'
            ]);
            
        DB::table('band_profiles')->insert([
                'name' => 'テストバンド２',
                'introduction' => 'テストです'
            ]);
            
        DB::table('band_profiles')->insert([
                'name' => 'テストバンド３',
                'introduction' => 'テストです'
            ]);    
        */
        
        //$user = UserProfile::all();
        
        
        /* 開発用 テストデータ　ユーザーとのリレーション付き
        $user = UserProfile::all();
        BandProfile::factory(10)-> create()
        -> each(function (BandProfile $band) use ($user) {
           $ran = rand(1, 6);
           
           $band-> user_profiles()-> attach(
               $user-> random($ran)-> pluck('id')-> toArray(),
               );
           });
        */
    }
}
