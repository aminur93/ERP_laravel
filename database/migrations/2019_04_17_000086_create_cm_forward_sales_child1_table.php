<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmForwardSalesChild1Table extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cm_forward_sales_child1';

    /**
     * Run the migrations.
     * @table cm_forward_sales_child1
     *
     * @return void
     */
    public function up()
    {
    if(!Schema::hasTable('cm_forward_sales_child1'))
    	{
        Schema::create($this->tableName, function (Blueprint $table) 
        	{
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cm_forward_sales_id');
            $table->integer('cm_file_id');
            $table->string('account_type', 20)->nullable();
            $table->string('withdrawal_amnt', 45)->nullable();

           
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
