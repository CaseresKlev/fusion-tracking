<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id')->nullable();
            $table->integer('company_id')->required();
            $table->integer('truck_id')->required();
            $table->integer('driver_id')->nullable();
            $table->string('ref_no', 20)->nullable();
            $table->string('stock_source', 100)->nullable();
            $table->string('item', 100)->required();
            $table->string('destination', 100)->nullable();
            $table->integer('quantity')->required();
            $table->string('accumulated_total', 20)->required();
            $table->string('entry_by', 100)->nullable();
            $table->date('date')->default(DB::raw('NOW()'));
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
        Schema::dropIfExists('expenses');
    }
}
