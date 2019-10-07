<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMrSeason extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mr_season', function (Blueprint $table) {
            //

        DB::Statement('ALTER TABLE mr_season DROP INDEX index3;');
        DB::Statement('ALTER TABLE `mr_season` ADD UNIQUE INDEX (
         `se_name`, 
         `b_id`, 
         `se_start`, 
         `se_end`);');
            $table->integer('season_status')->default(1)->comment('1=created, 0=close');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mr_season', function (Blueprint $table) {
            //
        });
    }
}
