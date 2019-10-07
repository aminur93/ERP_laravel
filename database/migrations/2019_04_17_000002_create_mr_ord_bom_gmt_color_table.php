<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrOrdBomGmtColorTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mr_ord_bom_gmt_color';

    /**
     * Run the migrations.
     * @table mr_ord_bom_gmt_color
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mr_ord_bom_gmt_color'))
        {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('mr_ord_bom_placement_id');
            $table->string('gmt_color', 45)->nullable()->default(null);
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
