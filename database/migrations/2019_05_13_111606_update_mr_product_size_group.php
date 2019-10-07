<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMrProductSizeGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mr_product_size_group', function (Blueprint $table) {
            //
             DB::statement("ALTER TABLE mr_product_size_group MODIFY br_id int null; ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mr_product_size_group', function (Blueprint $table) {
            //
        });
    }
}
