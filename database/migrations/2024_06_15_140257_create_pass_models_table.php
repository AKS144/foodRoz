<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass_table', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('pass_name')->nullable();
            $table->integer('number_of_orders')->nullable();
            $table->integer('validity')->nullable(); // assuming validity is an integer (e.g., number of days)
            $table->text('image')->nullable();
            $table->integer('limit_for_same_user')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->text('dishes')->nullable();
            $table->timestamps();
            $table->softDeletes(); // soft delete functionality
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pass_table');
    }
}
