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
            $table->string('name', 16);
            $table->foreignId('test_id')->constrained('tests')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->unsignedInteger('score');
            $table->unsignedInteger('school_ranking')->nullable();
            $table->unsignedInteger('school_people')->nullable();
            $table->unsignedInteger('national_ranking')->nullable();
            $table->unsignedInteger('national_people')->nullable();
            $table->unsignedDecimal('deviation_value', 3, 1)->nullable();
            $table->unsignedDecimal('average_score', 3, 1)->nullable();
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
