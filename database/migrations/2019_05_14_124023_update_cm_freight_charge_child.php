<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCmFreightChargeChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('cm_freight_charge_child', function (Blueprint $table) {
        //     //
        //     DB::Statement('alter table cm_freight_charge_child
        //         drop column freight_charge_child_id');
        //     $table->integer('cm_exp_data_entry_1_id')->after('cm_freight_charge_master_id')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cm_freight_charge_child', function (Blueprint $table) {
            //
        });
    }
}
