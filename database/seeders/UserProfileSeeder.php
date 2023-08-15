<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Models\UserProfile;
use App\Models\BandProfile;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profiles')->insert([
                'name' => '早瀬英和',
                'grade' => '3',
                'introduction' => 'テストなうです',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => '1',
            ]);
        
        /*
        DB::table('user_profiles')->insert([
                'name' => 'ダミー１',
                'grade' => '2',
                'introduction' => 'ダミー1です',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => '2',
            ]);
            
        DB::table('user_profiles')->insert([
                'name' => 'ダミー２',
                'grade' => '1',
                'introduction' => 'ダミー2です',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => '3',
            ]);
        */
        
        //$band =  BandProfile::factory(10)-> create();
        UserProfile::factory(9)-> create();
    }
}
