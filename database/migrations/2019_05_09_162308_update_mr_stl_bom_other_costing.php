<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMrStlBomOtherCosting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         DB::Statement('ALTER TABLE mr_stl_bom_other_costing
DROP COLUMN commercial_commision,
drop column buyer_commision,
drop column total_fabric,
drop column comercial_comision_percent,
drop column buyer_comission_percent,
drop column total_sewing,
drop column total_finishing,
drop column net_fob,
drop column final_fob,
drop column created_at,


add COLUMN commercial_cost float null ,
add column net_fob float null ,
add column buyer_comission_percent float null,
add column buyer_fob float null,

-- add column agent_comission_percent float null, 

add column agent_comission_percent float null,

add column agent_fob float null


');
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
