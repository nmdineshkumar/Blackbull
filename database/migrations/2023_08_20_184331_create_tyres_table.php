<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTyresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tyres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('pattern');
            $table->string('tyre_type');
            $table->integer('tyre_size');
            $table->string('origin');
            $table->string('manufactory_year');
            $table->integer('warranty_year')->nullable();
            $table->string('sku');
            $table->text('description')->nullable();
            $table->string('cars');
            $table->string('price');
            $table->text('image')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tyres');
    }
}
