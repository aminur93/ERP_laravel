<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmCashIncentiveStatusTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cm_cash_incentive_status';

    /**
     * Run the migrations.
     * @table cm_cash_incentive_status
     *
     * @return void
     */
    public function up()
    { 
    	if(!Schema::hasTable('cm_cash_incentive_status'))
        {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cnt_id')->nullable();
            $table->string('incentive', 20)->nullable();
            $table->string('type', 45)->nullable();
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
