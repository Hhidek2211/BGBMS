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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();   //ユーザープロファイルの必要最小限カラムのみ実装
            $table->timestamps();       
            $table->softdeletes();
            $table->string('name', 20);     //name = 名前　grade = 学年（通算で計算する、OB一年は5で考える） introduction = 自己紹介
            $table->integer('grade', false, true);
            $table->string('introduction', 200)->nullable();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
};
