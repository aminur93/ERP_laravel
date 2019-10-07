<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCmFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cm_file', function (Blueprint $table) {
            //
            DB::Statement('ALTER TABLE cm_file ALTER COLUMN file_type SET DEFAULT 1 ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cm_file', function (Blueprint $table) {
            //
        });
    }
}
