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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('grade')->unsigned();
            $table->string('group');
            $table->string('index')->nullable();
            $table->string('name');
            $table->string('teacher')->nullable();
            $table->smallInteger('hours_first_half')->default(0)->unsigned();
            $table->smallInteger('hours_second_half')->default(0)->unsigned();
            $table->string('class')->nullable();
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
        Schema::dropIfExists('subjects');
    }
};
