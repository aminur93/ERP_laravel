<?php

namespace App\Http\Controllers\Merch\OrderBOM;

use App\Http\Controllers\Controller;
use App\Models\Merch\ItemPlacement;
use App\Models\Merch\McatItem;
use App\Models\Merch\OrdBomGmtColor;
use App\Models\Merch\OrdBomItemColorMeasurement;
use App\Models\Merch\OrdBomPlacement;
use App\Models\Merch\OrderEntry;
use App\Models\Merch\ProductSize;
use App\Models\Merch\StyleSizeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderBomDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            //delete section
            /* check ,delete gmt color table and item color measuremt */
            if(isset($input['delete_gmt_color'])){
                $totalDeleteGmtColor = count($input['delete_gmt_color']);
                for ($dg=0; $dg < $totalDeleteGmtColor; $dg++) { 
                    $getGmtColor = OrdBomGmtColor::findOrFail($input['delete_gmt_color'][$dg]);
                    //delete item color measuremt
                    $getItemColorMeasurement = OrdBomItemColorMeasurement::deleteOrdBomItemColorMeasurementGmtColorIdWise($getGmtColor->id);
                    //delete gmt color
                    $getGmtColor->delete();
                }
            }
            /* check , delete order bom placement  */
            if(isset($input['delete_placement'])){
                $totalDeletePlacement = count($input['delete_placement']);
                for ($dp=0; $dp < $totalDeletePlacement; $dp++) { 
                    $getOrdBomPlacement = OrdBomPlacement::findOrFail($input['delete_placement'][$dp]);

                    foreach ($getOrdBomPlacement->gmt_color as $gColor) {
                        $getGmtColor = OrdBomGmtColor::findOrFail($gColor->id);
                        //delete item color measuremt
                        OrdBomItemColorMeasurement::deleteOrdBomItemColorMeasurementGmtColorIdWise($getGmtColor->id);
                        //delete gmt color
                        $getGmtColor->delete();
                    }

                    $getOrdBomPlacement->delete();
                }
            }
            //updated section
            if(isset($input['exsis_placements'])){
                $countEPlacement = count($input['exsis_placements']);
                for ($e=0; $e < $countEPlacement; $e++) { 
                    $getEPlacement = ItemPlacement::checkExsisPlacement($input['exsis_placements'][$e]); 
                    $placement = [
                        'placement' => $input['exsis_placements'][$e]
                    ];
                    if(!empty($getEPlacement)){
                        $placement_id = $getEPlacement->id;
                    }else{
                        $placement_id = ItemPlacement::create($placement)->id;
                    }
                    $ordBomPlacement = [
                        'order_id'     => $input['order_id'],
                        'item_id'      => $input['item_id'],
                        'placement_id' => $placement_id,
                        'description'  => $input['exsis_description'][$e]
                    ];
                    $getOrdBomPlacement = OrdBomPlacement::findOrFail($input['exsis_placement_id'][$e]);
                    $mr_ord_bom_placement_id = $input['exsis_placement_id'][$e];
                    $getOrdBomPlacement->update($ordBomPlacement);

                    $index = 1 + $e;
                    $countEGmtColor = count($input['exsis_gmt_color_'.$index]);

                    // create check update mr_ord_bom_gmt_color table
                    for ($eg=0; $eg < $countEGmtColor; $eg++) { 
                        $eGmtColor = [
                            'mr_ord_bom_placement_id' => $mr_ord_bom_placement_id,
                            'gmt_color'               => $input['exsis_gmt_color_'.$index][$eg]
                        ];

                        $getGmtColor = OrdBomGmtColor::findOrFail($input['exsis_gmt_color_id_'.$index][$eg]);
                        $mr_ord_bom_gmt_color_id = $input['exsis_gmt_color_id_'.$index][$eg];
                        $getGmtColor->update($eGmtColor);
                        
                        // create check update mr_ord_bom_item_color_measuremt table
                        $eitemColorMeasurement = [
                            'mr_ord_bom_gmt_color_id' => $mr_ord_bom_gmt_color_id,
                            'color_name'              => $input['exsis_item_color_'.$index][$eg],
                            'measurement'             => $input['exsis_measurement_'.$index][$eg],
                            'size'                    => $input['exsis_size_'.$index][$eg],
                            'type'                    => $input['exsis_type_'.$index][$eg],
                            'qty'                     => $input['exsis_qty_'.$index][$eg]
                        ];
                        $eGetItemColorMeasurement = OrdBomItemColorMeasurement::findOrFail($input['exsis_item_color_measurement_id_'.$index][$eg]);
                        $eGetItemColorMeasurement->update($eitemColorMeasurement);
                        
                    }

                    //add extra add gmt color item color measurement
                    if(isset($input['gmt_color_'.$index])){
                        $countGmtColor = count($input['gmt_color_'.$index]);
                        for ($ng=0; $ng < $countGmtColor; $ng++) { 
                            //add extra gmt color
                            $gmtColor = [
                                'mr_ord_bom_placement_id' => $mr_ord_bom_placement_id,
                                'gmt_color'               => $input['gmt_color_'.$index][$ng]
                            ];

                            $getGmtColor = OrdBomGmtColor::checkExsisOrdBomGmtColor($gmtColor);
                            $n_mr_ord_bom_gmt_color_id = OrdBomGmtColor::create($gmtColor)->id;
                            
                            // create check update mr_ord_bom_item_color_measuremt table
                            $itemColorMeasurement = [
                                'mr_ord_bom_gmt_color_id' => $n_mr_ord_bom_gmt_color_id,
                                'color_name'              => $input['item_color_'.$index][$ng],
                                'measurement'             => $input['measurement_'.$index][$ng],
                                'size'                    => $input['size_'.$index][$ng],
                                'type'                    => $input['type_'.$index][$ng],
                                'qty'                     => $input['qty_'.$index][$ng]
                            ];
                            $getItemColorMeasurement = OrdBomItemColorMeasurement::checkExsisOrdBomItemColorMeasurement($itemColorMeasurement);
                            OrdBomItemColorMeasurement::create($itemColorMeasurement);
                             
                        }
                    }
                    
                }
            }

            //insert section
            if(isset($input['placements'])){
                $countPlacement = count($input['placements']);
                // create check update mr_ord_bom_placement table

                for ($i=0; $i < $countPlacement; $i++) { 
                    //create check update mr_item_placement table
                    $getPlacement = ItemPlacement::checkExsisPlacement($input['placements'][$i]);
                    $placement = [
                        'placement' => $input['placements'][$i]
                    ];
                    if(!empty($getPlacement)){
                        $placement_id = $getPlacement->id;
                    }else{
                        $placement_id = ItemPlacement::create($placement)->id;
                    }
                    $ordBomPlacement = [
                        'order_id'     => $input['order_id'],
                        'item_id'      => $input['item_id'],
                        'placement_id' => $placement_id,
                        'description'  => $input['description'][$i]
                    ];
                    $getOrdBomPlacement = OrdBomPlacement::checkExsisOrdBomPlacement($ordBomPlacement);
                    if(!empty($getOrdBomPlacement)){
                        $mr_ord_bom_placement_id = $getOrdBomPlacement->id;
                    }else{
                        $mr_ord_bom_placement_id = OrdBomPlacement::create($ordBomPlacement)->id;
                    }

                    $index = $input['place'][$i];
                    $countGmtColor = count($input['gmt_color_'.$index]);
                    // create check update mr_ord_bom_gmt_color table
                    for ($g=0; $g < $countGmtColor; $g++) { 
                        $gmtColor = [
                            'mr_ord_bom_placement_id' => $mr_ord_bom_placement_id,
                            'gmt_color'               => $input['gmt_color_'.$index][$g]
                        ];

                        $getGmtColor = OrdBomGmtColor::checkExsisOrdBomGmtColor($gmtColor);
                        $mr_ord_bom_gmt_color_id = OrdBomGmtColor::create($gmtColor)->id;
                        

                        // create check update mr_ord_bom_item_color_measuremt table
                        $itemColorMeasurement = [
                            'mr_ord_bom_gmt_color_id' => $mr_ord_bom_gmt_color_id,
                            'color_name'              => $input['item_color_'.$index][$g],
                            'measurement'             => $input['measurement_'.$index][$g],
                            'size'                    => $input['size_'.$index][$g],
                            'type'                    => $input['type_'.$index][$g],
                            'qty'                     => $input['qty_'.$index][$g]
                        ];
                        $getItemColorMeasurement = OrdBomItemColorMeasurement::checkExsisOrdBomItemColorMeasurement($itemColorMeasurement);
                        OrdBomItemColorMeasurement::create($itemColorMeasurement);
                        
                    }
                }  
            }
            $msg = 'Successfully set BOM item details setup';
            $this->logFileWrite($msg, $input['order_id']);
            DB::commit(); 
            return redirect()->back()->with('success', $msg);
        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return redirect()->back()->with('error',$bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function orderIdItemIdWise(Request $request)
    {
        $input = $request->all();
        $getItem = McatItem::find($input['item_id'], ['item_name']);
        $data['item_name'] = $getItem->item_name;
        $getOrder = OrderEntry::select('order_qty')->where('order_id', $input['order_id'])->first();
        $data['item_qty'] = $getOrder->order_qty;
        $data['getOrderDetails'] = OrdBomPlacement::getOrderIdItemIdWise($input);
        return $data;
    }

    public function itemWiseSizeGroup(Request $request)
    {
        $input = $request->all();
        $stlSizeGroup = StyleSizeGroup::getSizeGroupIdStyleIdWise($input['style_id']);
        $size = [];
        foreach ($stlSizeGroup as $stl) {
            $getSize = ProductSize::getPalleteNameSizeGroupIdWise($stl->mr_product_size_group_id, $input['name_startsWith']);
            foreach ($getSize as $pSize) {
                $size[] = $pSize->mr_product_pallete_name.'|'.'yes';
            }

        }
        return array_unique($size);
        //return "hi";
    }

    public function itemWisePlacement(Request $request)
    {
        $input = $request->all();
        $getPlacement = ItemPlacement::searchItemPlacement($input['name_startsWith']);
        $data = array();
        foreach ($getPlacement as $placements) {
            $data[] = $placements->placement.'|'.'yes';
        }
        return $data;
    }
}
