<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCmPiBom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cm_pi_bom', function (Blueprint $table) {
            //ALTER TABLE cm_pi_bom MODIFY `mr_material_color_clr_id` int NULL 
            DB::statement("ALTER TABLE cm_pi_bom MODIFY id INT NOT NULL AUTO_INCREMENT");
            DB::statement("ALTER TABLE cm_pi_bom MODIFY `mr_material_color_clr_id` int NULL");
            DB::statement("ALTER TABLE cm_pi_bom MODIFY `mr_article_id` int NULL");
            DB::statement("ALTER TABLE cm_pi_bom MODIFY `mr_composition_id` int NULL");
            DB::statement("ALTER TABLE cm_pi_bom MODIFY `mr_construction_id` int NULL");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cm_pi_bom', function (Blueprint $table) {
            //
        });
    }
}
