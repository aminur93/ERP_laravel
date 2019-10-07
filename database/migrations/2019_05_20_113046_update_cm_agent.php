<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCmAgent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cm_agent', function (Blueprint $table) {
            //
            //$table->bigIncrements('id');
            DB::statement("ALTER TABLE cm_agent MODIFY id INT NOT NULL AUTO_INCREMENT");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cm_agent', function (Blueprint $table) {
            //
        });
    }
}
