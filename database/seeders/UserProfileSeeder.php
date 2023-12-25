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
        // 自分
        DB::table('user_profiles')->insert([
                'name' => '早瀬英和',
                'grade' => '3',
                'introduction' => 'よろしくお願いします',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => '1',
            ]);
        $insts = [1, 2, 3];
        foreach ($insts as $inst) {
                DB::table('instrument_user_profile')->insert([
                'instrument_id' => $inst,
                'user_profile_id' => '1'
            ]);
        }
            
        // テストユーザー
        DB::table('user_profiles')->insert([
                'name' => 'テストユーザー',
                'grade' => '1',
                'introduction' => 'テスト用ユーザー',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => '2',
            ]);        
        $insts = [1, 2, 3, 4, 5, 6];
        foreach ($insts as $inst) {
                DB::table('instrument_user_profile')->insert([
                'instrument_id' => $inst,
                'user_profile_id' => '2'
            ]);
        }
            
        
        
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
        
        // 開発環境用 テストユーザーデータ
        //UserProfile::factory(9)-> create();
    }
}
