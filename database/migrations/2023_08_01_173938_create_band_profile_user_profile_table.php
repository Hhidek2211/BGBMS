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
        Schema::create('band_profile_user_profile', function (Blueprint $table) {
            $table->foreignId('band_profile_id')->constrained('band_profiles');
            $table->foreignId('user_profile_id')->constrained('user_profiles');
            $table->primary(['band_profile_id','user_profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('band_profile_user_profile');
    }
};
