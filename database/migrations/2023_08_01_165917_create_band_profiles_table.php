<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('band_profiles', function (Blueprint $table) {
            $table->id();   //最小限のカラムのみ実装
            $table->timestamps();
            $table->Softdeletes();
            $table->string('name', 20);     //name = バンド名 introduction = バンド紹介文 
            $table->string('introduction', 300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('band_profiles');
    }
};
