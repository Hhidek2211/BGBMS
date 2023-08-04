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
            'name' =>'Fiddle',
            ]);
            
        DB::table('instruments')->insert([
            'name' =>'Banjo',
            ]);
            
        DB::table('instruments')->insert([
            'name' =>'Mandolin',
            ]);
            
        DB::table('instruments')->insert([
            'name' =>'Dobro',
            ]);
            
        DB::table('instruments')->insert([
            'name' =>'Base',
            ]);
            
        DB::table('instruments')->insert([
            'name' =>'Guiter',
            ]);
            
    }
}
