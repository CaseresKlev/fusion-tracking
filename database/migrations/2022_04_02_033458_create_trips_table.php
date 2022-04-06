<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->Integer('trip_ticket_id')->required();
            $table->Integer('driver_id')->required();
            $table->Integer('truck_id')->required();
            $table->String('source', 100)->required();
            $table->String('destination', 100)->required();
            $table->Double('distance')->required();
            $table->Double('weigth')->required();
            $table->Double('rate')->required();
            $table->Double('bill')->required();
            $table->string('material', 100)->nullable();
            $table->string('contractor', 100)->nullable();
            $table->string('loaded_by', 100)->nullable();
            $table->string('loaded_time', 100)->nullable();
            $table->string('tx_no', 100)->nullable();
            $table->Integer('entry_by')->nullable();
            $table->date('date')->required()->default(date("Y-m-d"));;
            $table->timestamps();
        });

        DB::unprepared("ALTER TABLE trips AUTO_INCREMENT = 100000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
