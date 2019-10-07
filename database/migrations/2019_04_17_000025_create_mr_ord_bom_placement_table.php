<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrOrdBomPlacementTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mr_ord_bom_placement';

    /**
     * Run the migrations.
     * @table mr_ord_bom_placement
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mr_ord_bom_placement'))
       { 
        Schema::create($this->tableName, function (Blueprint $table) {
                   $table->engine = 'InnoDB';
                   $table->increments('id');
                   $table->integer('order_id');
                   $table->integer('item_id');
                   $table->integer('placement_id');
                   $table->string('description', 60)->nullable()->default(null);
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
