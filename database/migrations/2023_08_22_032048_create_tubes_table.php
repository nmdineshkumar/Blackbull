<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTubesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tubes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('height');
            $table->string('rim_size');
            $table->string('brand');
            $table->string('origin');
            $table->string('volvo');
            $table->string('sku');
            $table->text('description')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('tubes');
    }
}
