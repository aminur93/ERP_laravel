<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMrCapacityReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mr_capacity_reservation', function (Blueprint $table) {
        DB::Statement('alter table mr_capacity_reservation add unique index(`hr_unit_id`,`b_id`,`res_month`,`prd_type_id`);');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mr_capacity_reservation', function (Blueprint $table) {
            //
        });
    }
}
