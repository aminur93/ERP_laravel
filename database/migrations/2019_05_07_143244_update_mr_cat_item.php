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
    public $table="mr_cat_item";
    public function up()
    {
        //
            Schema::table('mr_cat_item', function($table)
            {
                $table->integer('depedent_on')->after('item_code')->comment("1=Color;2=Size;3=Size&Color;0=none");
            });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
