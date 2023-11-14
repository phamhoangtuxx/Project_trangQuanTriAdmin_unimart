<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->string('username');
            $table->integer('phone')->nullable();
            $table->string('name', 50);
            $table->integer('quantity')->default(0);
            $table->integer('price');
            $table->string('status')->default('Đang xử lí');
            $table->unsignedBigInteger('order_id');


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
        Schema::dropIfExists('dashboard');
    }
}
