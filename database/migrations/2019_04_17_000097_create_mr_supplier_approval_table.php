<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrSupplierApprovalTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mr_supplier_approval';

    /**
     * Run the migrations.
     * @table mr_supplier_approval
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('mr_supplier_approval')) 
        {
     // create the tblCategory table

        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 45)->nullable()->comment('precost/ cm/ fob/fabric/sewing/finishing cost change');
            $table->integer('sup_id')->nullable();
            $table->string('submit_by', 60)->nullable()->comment('1 for approved/2 for declined');
            $table->string('submit_to', 60)->nullable();
            $table->string('comments', 145)->nullable();
            $table->integer('status')->nullable()->comment('0=Created
1=Submitted
2=Approved');
            $table->timestamp('created_on')->nullable();
            $table->integer('level')->nullable();

            
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
