<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HrSalaryAddDeduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'hr_salary_add_deduct';


    public function up()
    {
        if(!Schema::hasTable('hr_salary_add_deduct'))
        {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('associate_id', 10);
                $table->integer('month');
                $table->integer('year');
                $table->double('advp_deduct')->nullable();
                $table->double('cg_deduct')->nullable();
                $table->double('food_deduct')->nullable();
                $table->double('others_deduct')->nullable();
                $table->double('salary_add')->nullable();
                $table->timestamp('created_on')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->string('created_by', 10);
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
        //
    }
}
