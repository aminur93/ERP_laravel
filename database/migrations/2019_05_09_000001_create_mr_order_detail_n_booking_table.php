<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrOrderDetailNBookingTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mr_order_detail_n_booking';

    /**
     * Run the migrations.
     * @table mr_order_detail_n_booking
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable($this->tableName))
        {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('mr_order_bom_costing_booking_id')->nullable();
                $table->integer('mr_order_entry_order_id')->nullable();
                $table->integer('mr_cat_item_id')->nullable();
                $table->integer('mr_cat_item_mcat_id')->nullable();
                $table->integer('mr_material_color_clr_id')->nullable();
                $table->string('size', 20)->nullable();
                $table->float('qty')->nullable();
                $table->float('req_qty')->nullable();
                $table->float('total_value')->nullable();
                $table->float('booking_qty')->nullable();
                $table->date('delivery_date')->nullable();
                $table->nullableTimestamps();

               
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
       Schema::dropIfExists($this->tableName);
     }
}
