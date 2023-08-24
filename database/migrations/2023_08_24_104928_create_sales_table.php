<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('customer');
            $table->string('invoice_no');
            $table->timestamp('invocie_date');
            $table->string('qty')->nullable()->default(0);
            $table->string('tax')->nullable();
            $table->string('total');
            $table->string('created_by');
            $table->string('updated_by')->nullable()->default();
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
        Schema::dropIfExists('invoice');
    }
}
