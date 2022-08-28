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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->foreignId('schedule_id')->nullable()->constrained('template_lessons')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('custom_name')->nullable();
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
        Schema::dropIfExists('lessons');
    }
};
