<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCmCashIncentiveChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('cm_cash_incentive_child', function (Blueprint $table) {
        //     //
        //     $table->integer('cm_exp_data_entry_1_id')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cm_cash_incentive_child', function (Blueprint $table) {
            //
        });
    }
}
