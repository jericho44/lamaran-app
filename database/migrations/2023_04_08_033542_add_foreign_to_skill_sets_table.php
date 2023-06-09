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
        Schema::table('skill_sets', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('skill_id')->references('id')->on('skills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skill_sets', function (Blueprint $table) {
            $table->dropForeign('skill_sets_candidate_id_foreign');
            $table->dropForeign('skill_sets_skill_id_foreign');
        });
    }
};
