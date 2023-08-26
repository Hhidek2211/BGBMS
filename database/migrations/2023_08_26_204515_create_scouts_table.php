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
        Schema::create('scouts', function (Blueprint $table) {
            $table-> id();
            $table-> foreignID('user_profile_id')-> constrained('user_profiles');
            $table-> foreignID('band_profile_id')-> constrained('band_profiles');
            $table-> string('title');
            $table-> string('message');
            $table-> timestamps();
            $table-> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scouts');
    }
};
