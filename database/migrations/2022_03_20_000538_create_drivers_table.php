<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 50)->required();
            $table->string('middlename', 50)->nullable();
            $table->string('lastname', 50)->required();
            $table->string('address', 255)->nullable();
            $table->string('contact_no', 25)->nullable();;
            $table->string('position', 30)->nullable();
            $table->string('trip_status', 30)->nullable();;
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
        Schema::dropIfExists('drivers');
    }
}
