<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmPaymentPlanningTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cm_payment_planning';

    /**
     * Run the migrations.
     * @table cm_payment_planning
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('cm_payment_planning'))
        {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('cm_exp_data_entry_1_id')->nullable();
            $table->integer('cm_imp_data_entry_id')->nullable();
            $table->string('planning_code', 45)->nullable();
            $table->timestamp('created_on')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

           
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
