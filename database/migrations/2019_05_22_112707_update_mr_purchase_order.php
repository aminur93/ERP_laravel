<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMrPurchaseOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('mr_purchase_order', function (Blueprint $table) {
            
            DB::Statement('ALTER TABLE `mr_purchase_order` ADD UNIQUE INDEX (
             `po_no`, 
             `po_delivery_country`);');
            
            //
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mr_purchase_order', function (Blueprint $table) {
            //
        });
    }
}
