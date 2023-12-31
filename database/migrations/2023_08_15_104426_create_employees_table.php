<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')
                    ->references('id')
                    ->on('departments')
                    ->onDelete('cascade');
            $table->string('location')->nullable();
            $table->string('mobile');
            $table->string('email');
            $table->integer('email_verified')->default('0');
            $table->string('position')->nullable();
            $table->string('password');
            $table->timestamp('joining_date')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')
                    ->references('id')
                    ->on('branches')
                    ->onDelete('cascade');
            $table->string('photo')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
