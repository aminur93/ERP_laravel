<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMrOrderBomCostingBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mr_order_bom_costing_booking', function (Blueprint $table) {
            //
            $table->integer('depend_on')->comment('1=Color;2=Size;3=Color+Size;0=none')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mr_order_bom_costing_booking', function (Blueprint $table) {
            //
        });
    }
}
