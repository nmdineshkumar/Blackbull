<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductstocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productstocks', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('product_id');
            $table->string('current_qty');
            $table->string('old_qty')->default(0);
            $table->string('overall_qty')->default(0);
            $table->string('online_purchases')->default(0);
            $table->string('offline_purchases')->default(0);
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
        Schema::dropIfExists('productstocks');
    }
}
