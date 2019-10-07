<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMrWashType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mr_wash_type', function (Blueprint $table) {
            DB::Statement('alter table mr_wash_type 
                drop column wash_rate');
            $table->integer('mr_wash_category_id');
            $table->float('process_time')->unsigned()->default(0)->nullable();
            $table->string('chemical',45)->nullable();
            $table->float('consumption_rate')->unsigned()->default(0)->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mr_wash_type', function (Blueprint $table) {
            //
        });
    }
}
