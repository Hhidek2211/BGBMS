<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class InstrumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('instruments')->insert([
            'name' =>'Banjo',
            'name_abb'=>'Bj',
            'name_jp'=>'バンジョー'
            ]);
            
        DB::table('instruments')->insert([
            'name' =>'Fiddle',
            'name_abb'=>'Fd',
            'name_jp'=>'フィドル'
            ]);
                        
        DB::table('instruments')->insert([
            'name' =>'Guiter',
            'name_abb'=>'Gt',
            'name_jp'=>'ギター'
            ]);
            
        
        DB::table('instruments')->insert([
            'name' =>'Mandolin',
            'name_abb'=>'Md',
            'name_jp'=>'マンドリン'
            ]);
            
        DB::table('instruments')->insert([
            'name' =>'Dobro',
            'name_abb'=>'Db',
            'name_jp'=>'ドブロ'
            ]);
            
        DB::table('instruments')->insert([
            'name' =>'Base',
            'name_abb'=>'Bs',
            'name_jp'=>'ベース'
            ]);
            

            
    }
}
