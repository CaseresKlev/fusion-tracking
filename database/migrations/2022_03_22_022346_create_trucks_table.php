<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->required();
            $table->string('brand', 50)->nullable();
            $table->string('model', 50)->nullable();
            $table->string('plate_no', 25)->nullable();
            $table->string('owner', 50)->nullable();
            $table->string('status', 50)->nullable();

            $table->string('description', 255)->nullable();
            $table->string('company_id')->integer()->required()->default('1');
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
        Schema::dropIfExists('trucks');
    }
}
