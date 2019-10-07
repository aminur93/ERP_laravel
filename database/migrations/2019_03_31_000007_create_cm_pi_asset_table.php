<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmPiAssetTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cm_pi_asset';

    /**
     * Run the migrations.
     * @table cm_pi_asset
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable($this->tableName))
        {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('cm_file_id');
                $table->integer('hr_unit')->nullable();
                $table->integer('cm_item_id')->nullable();
                $table->string('pi_no', 45)->nullable();
                $table->date('pi_date')->nullable();
                $table->date('pi_last_ship_date')->nullable();
                $table->integer('mr_supplier_sup_id')->nullable();
                $table->enum('active_pi', ['Yes', 'no'])->nullable();
                $table->enum('pi_status', ['Foreign', 'Local'])->nullable();
                $table->string('remarks', 75)->nullable();
                $table->string('btb_lc_no', 45)->nullable();
                $table->enum('advance_payment_mode', ['TT', 'FDD'])->nullable();

               
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
