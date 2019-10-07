<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMrCatItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mr_cat_item', function (Blueprint $table) {
            //
            DB::Statement('ALTER TABLE `mr_cat_item` CHANGE COLUMN `depedent_on` dependent_on int(11);
');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mr_cat_item', function (Blueprint $table) {
            //
        });
    }
}
