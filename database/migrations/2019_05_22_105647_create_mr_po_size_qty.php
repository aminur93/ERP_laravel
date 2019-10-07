<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrPoSizeQty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mr_po_size_qty'))
        {
        Schema::create('mr_po_size_qty', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('mr_po_sub_style_id');
            $table->integer('mr_product_size_id');
            $table->integer('qty')->nullable();
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
        Schema::table('mr_po_size_qty', function (Blueprint $table) {
            //
        });
    }
}
