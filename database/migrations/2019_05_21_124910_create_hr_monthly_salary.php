<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrMonthlySalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        if(!Schema::hasTable('hr_monthly_salary'))
        {
            Schema::create('hr_monthly_salary', function (Blueprint $table) {
                $table->increments('id');
                $table->varchar('as_id');
                $table->integer('month')->default(0);
                $table->year('year')->default(0);
                $table->float('gross')->default(0);
                $table->float('basic')->default(0);
                $table->float('house')->default(0);
                $table->float('medical')->default(0);
                $table->float('transport')->default(0);
                $table->float('food')->default(0);
                $table->integer('late_count')->default(0);
                $table->integer('present')->default(0);
                $table->integer('holiday')->default(0);
                $table->integer('absent')->default(0);
                $table->integer('leave')->default(0);
                $table->float('absent_deduct')->default(0);
                $table->float('half_day_deduct')->default(0);
                $table->integer('salary_add_deduct_id')->nullable();
                $table->float('salary_payable')->default(0);
                $table->float('ot_rate')->default(0);
                $table->float('ot_hour')->default(0);
                $table->float('attendance_bonus')->default(0);
                $table->varchar('created_by')->nullable();
                $table->varchar('updated_by')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('hr_monthly_salary');
    }
}
