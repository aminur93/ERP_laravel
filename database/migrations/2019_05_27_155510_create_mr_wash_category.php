<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrWashCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mr_wash_category'))
        {

        Schema::create('mr_wash_category', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('category_name',30);
        });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mr_wash_category', function (Blueprint $table) {
            //
        });
    }
}
