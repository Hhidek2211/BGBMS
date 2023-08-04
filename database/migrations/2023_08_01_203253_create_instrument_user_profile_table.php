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
        Schema::create('instrument_user_profile', function (Blueprint $table) {
            $table->foreignId('instrument_id')->constrained('instruments');
            $table->foreignId('user_profile_id')->constrained('user_profiles');
            $table->primary(['instrument_id','user_profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instrument_user_profile');
    }
};
