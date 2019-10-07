<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCmPassbookVolume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cm_passbook_volume', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE cm_passbook_volume MODIFY id INT NOT NULL AUTO_INCREMENT");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cm_passbook_volume', function (Blueprint $table) {
            //
        });
    }
}
