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
        //TODO:コメント解除
        // Schema::create('school_codes', function (Blueprint $table) {

        //     $table->string('school_code')->index();
        //     $table->string('prefecture_code')->references('prefecture_code')->on('prefectureCodes');
        //     $table->string('name');
        //     $table->string('kind_of_school');

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //TODO:コメント解除
        // Schema::dropIfExists('school_codes');
    }
};
