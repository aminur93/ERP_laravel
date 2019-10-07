<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCmBtbAmend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cm_btb_amend', function (Blueprint $table) {
            //
        DB::statement("ALTER TABLE cm_btb_amend MODIFY id INT NOT NULL AUTO_INCREMENT");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cm_btb_amend', function (Blueprint $table) {
            //
        });
    }
}
