<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DateTime;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'devhhide1011@gmail.com',
            'password' => Hash::make('ma2211me'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
        /*
        DB::table('users')->insert([
            'name' => 'dummy01',
            'email' => 'dummy01@gmail.com',
            'password' => Hash::make('ma2211me'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
        DB::table('users')->insert([
            'name' => 'dummy02',
            'email' => 'dummy02@gmail.com',
            'password' => Hash::make('ma2211me'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        */
        
        User::factory(9)-> create();
        
    }
}
