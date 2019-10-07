<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMrTnaTemplateToLibrary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('cm_cash_incentive_status'))
        {
        Schema::table('mr_tna_template_to_library', function (Blueprint $table) {
            //$table->dropColumn('tna_temp_logic');
            //$table->enum('tna_temp_logic',array('Grams','Kgs.','Pounds'))->nullable()->after('mr_tna_library_id');
            //
            DB::statement("ALTER TABLE mr_tna_template_to_library CHANGE COLUMN tna_temp_logic tna_temp_logic ENUM('OK to Begin', 'DCD or FOB') ");
            $table->integer('offset_day');

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
        Schema::table('mr_tna_template_to_library', function (Blueprint $table) {
            //
        });
    }
}
