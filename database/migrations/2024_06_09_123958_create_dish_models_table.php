<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('display_price', 8, 2)->nullable();
            $table->decimal('maximum_seller_price', 8, 2)->nullable();
            $table->decimal('discount')->nullable();
            $table->enum('discount_type', ['amount', 'percentage'])->nullable();
            $table->enum('item_type', ['veg', 'non_veg', 'vegan'])->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('dish_attributes')->nullable();
            $table->text('addons')->nullable();
            $table->time('available_time_starts')->nullable();
            $table->time('available_time_ends')->nullable();
            $table->integer('preparation_time')->nullable();
            $table->string('footer_note')->nullable();
            $table->string('image')->nullable();
            $table->text('metadata')->nullable();
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
        Schema::dropIfExists('dishes');
    }
}
