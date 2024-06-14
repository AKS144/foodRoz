<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times_slots', function (Blueprint $table) {
            $table->id();
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
            $table->enum('happy_hour_tag', ['Active', 'Inactive'])->default('Inactive')->nullable();
            $table->string('happy_hour_image')->nullable();
            $table->decimal('happy_hour_discount', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes(); // Add this line for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times_slots');
    }
}
