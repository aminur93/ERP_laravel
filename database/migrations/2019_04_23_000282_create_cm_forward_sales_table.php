<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmForwardSalesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cm_forward_sales';

    /**
     * Run the migrations.
     * @table cm_forward_sales
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('cm_forward_sales'))
        {Schema::create($this->tableName, function (Blueprint $table) {
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->date('booking_date')->nullable();
                    $table->integer('cm_bank_id');
                    $table->string('forward_amnt', 20)->nullable();
                    $table->string('sales_done', 10)->nullable();
                    $table->string('remarks', 65)->nullable();
                    $table->string('exchange_rate', 45)->nullable();
                    $table->date('maturity_window_start')->nullable();
                    $table->date('maturity_window_end')->nullable();
                    $table->timestamp('created_on')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
        
                 
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
