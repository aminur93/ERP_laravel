<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmForwardSalesChild2Table extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cm_forward_sales_child2';

    /**
     * Run the migrations.
     * @table cm_forward_sales_child2
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('cm_forward_sales_child2'))
        {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cm_forward_sales_id');
            $table->date('encashment_date')->nullable();
            $table->string('amount', 45)->nullable();
            $table->string('balance', 45)->nullable();

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
