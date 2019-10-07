<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrItemPlacementTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mr_item_placement';

    /**
     * Run the migrations.
     * @table mr_item_placement
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mr_item_placement'))
        {Schema::create($this->tableName, function (Blueprint $table) {
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->string('placement', 45)->nullable()->default(null);
                    $table->nullableTimestamps();
                });}
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
