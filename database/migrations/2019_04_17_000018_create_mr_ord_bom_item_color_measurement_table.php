<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrOrdBomItemColorMeasurementTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mr_ord_bom_item_color_measurement';

    /**
     * Run the migrations.
     * @table mr_ord_bom_item_color_measurement
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mr_ord_bom_item_color_measurement'))
        {
            Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('mr_ord_bom_gmt_color_id');
            $table->string('color_name', 20)->nullable()->default(null);
            $table->string('measurement', 20)->nullable()->default(null);
            $table->string('size', 20)->nullable()->default(null);
            $table->string('type', 20)->nullable()->default(null);
            $table->string('qty', 20)->nullable()->default(null);
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
