<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCmFreightChargeMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('cm_freight_charge_master', function (Blueprint $table) {
        //     DB::Statement('alter table cm_freight_charge_master drop column cm_exp_data_entry_1_id');
        //     //
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cm_freight_charge_master', function (Blueprint $table) {
            //
        });
    }
}
