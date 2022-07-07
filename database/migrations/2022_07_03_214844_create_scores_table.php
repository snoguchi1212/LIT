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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('test_id')->constrained('tests'); //#TODO:foreign
            $table->foreignId('subject_id')->constrained('subjects'); //#TODO:foreign
            $table->integer('score');
            $table->integer('school_ranking')->nullable();
            $table->integer('school_people')->nullable();
            $table->integer('national_ranking')->nullable();
            $table->integer('national_people')->nullable();
            $table->double('deviation_value', 3, 1)->nullable();
            $table->double('average_score', 3, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
};
