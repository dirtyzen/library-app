<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->enum('status', ['waiting', 'delivered', 'returned']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('employee_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leases');
    }
}
