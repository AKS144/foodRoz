<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToAddOns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('add_ons', function (Blueprint $table) {
            $table->decimal('display_price', 24, 2)->nullable();
            $table->text('description')->nullable();
            $table->decimal('discount', 24, 2)->nullable();
            $table->enum('discount_type', ['Amount', 'Percentage'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('add_ons', function (Blueprint $table) {
            $table->dropColumn('display_price');
            $table->dropColumn('description');
            $table->dropColumn('discount');
            $table->dropColumn('discount_type');
        });
    }
}
