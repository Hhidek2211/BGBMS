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
        Schema::table('band_profiles', function (Blueprint $table) {
            $table->foreignId('recruitment_id')-> nullable()-> constrained('recruitments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('band_profiles', function (Blueprint $table) {
            $table-> dropforeign(['recruitment_id']);
        });
    }
};
