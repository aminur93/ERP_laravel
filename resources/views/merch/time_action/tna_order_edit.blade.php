@extends('merch.index')
@section('content')

<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Merchandising </a>
                </li> 
                <li>
                    <a href="#"> Time & Action </a>
                </li>
                  
                <li class="active">Order TNA </li>
            </ul><!-- /.breadcrumb --> 
        </div>


        <div class="page-content"> 
              <div class="page-header">
                <h1>Time & Action <small><i class="ace-icon fa fa-angle-double-right"></i> Order TNA</small></h1>
            </div>           
        
            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <!-- -Form 1----------------------> 
                <form class="form-horizontal col-sm-12" role="form" method="post" action="{{ url('merch/time_action/tna_order_update')}}" enctype="multipart/form-data">
                  {{ csrf_field() }} 

                  <div class="col-sm-5">
                      <h5 class="page-header">TNA Generate</h5>
                      <!-- PAGE CONTENT BEGINS -->
                      <div class="form-horizontal">

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="mbm_order" >MBM Order<span style="color: red">&#42;</span> </label>

                              <div class="col-sm-8">
                                
                                {{ Form::select('mbm_order', $order_en, $tna->order_id, ['placeholder'=>'Select ','id'=>'order_id','class'=> 'col-xs-12', 'data-validation' => 'required']) }}
                             </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="confirm_date" >Confirm Date <span style="color: red">&#42;</span> </label>

                              <div class="col-sm-8">
                                  <input type="text" name="confirm_date" id="confirm_date" class="datepicker col-xs-12" value="{{$tna->confirm_date}}" data-validation="required" autocomplete="off" placeholder="Y-m-d" />
                                 
                              </div> 
                               <div id="msg" class="col-sm-9 pull-right" style="color: red">
                               </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="lead_days" >Lead Days <span style="color: red">&#42;</span> </label>

                              <div class="col-sm-8">
                                 <input type="text" id="lead_days" name="lead_days" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([0-9]+)$"
                                 value="{{$tna->lead_days}}"/>
                                 
                              </div> 
                               <div id="msg" class="col-sm-9 pull-right" style="color: red">
                               </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="tolerance_days" >Tolerance Days <span style="color: red">&#42;</span> </label>

                              <div class="col-sm-8">
                                 <input type="text" id="tolerance_days" name="tolerance_days" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([0-9]+)$" value="{{$tna->tolerance_days}}"/>
                                 
                              </div> 
                              <div id="msg" class="col-sm-9 pull-right" style="color: red">
                              </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="tna_templatetype" >TNA Type <span style="color: red">&#42;</span> </label>
                              <div class="col-sm-8">
                                 {{ Form::select('tna_templatetype', $tnatype, $tna->mr_tna_template_id, ['placeholder'=>'Select ','id'=>'tna_type','class'=> 'col-xs-12', 'data-validation' => 'required']) }}

                              </div> 
                               <div id="msg" class="col-sm-9 pull-right" style="color: red">
                               </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="ok_to_begin" >OK to Begin <span style="color: red">&#42;</span> </label>
                              <div class="col-sm-8">
                                <input type="text" name="ok_to_begin" id="ok_to_begin" class="datepicker col-xs-12" value="{{$tna->begin_date}}" data-validation="required" autocomplete="off" placeholder="Y-m-d" />                              
                              </div> 
                              <div id="msg" class="col-sm-9 pull-right" style="color: red">
                              </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="rev_ok_to_begin" >Rev OK to Begin <span style="color: red">&#42;</span> </label>
                              <div class="col-sm-8">
                                <input type="text" name="rev_ok_to_begin" id="rev_ok_to_begin" class="datepicker col-xs-12" value="{{$tna->revise_begin_date}}" data-validation="required" autocomplete="off" placeholder="Y-m-d" />                            
                              </div> 
                              <div id="msg" class="col-sm-9 pull-right" style="color: red">
                              </div>
                        </div>
                                                 
                      </div>
                      
                    </div>     
                  <!-- /.col -->
                  <div class="col-sm-7 tna-generate">
                    <h5 class="page-header">Time & Action</h5>
                    <table class="table responsive" style="width:100%;border:1px solid #ccc;font-size:12px;"  cellpadding="2" cellspacing="0" border="1" align="center"> 
                        <thead>
                            <tr>
                              <th style="text-align:center">SL</th>
                              <th style="text-align:center">Activity</th>
                              <th style="text-align:center">Sys. Gen. Date </th>
                              <th style="text-align:center">Actual Date </th>
                              <th style="text-align:center">Remark</th>
                            </tr> 
                        </thead>
                        <tbody>                    

                          @php($i=1)
                             <?php 
                              date_default_timezone_set('Asia/Dhaka');
                              $order_a= DB::table('mr_order_entry AS o')
                                     ->select([
                                      'o.order_delivery_date'
                                    ])
                                 ->where('order_id',$tna->order_id)
                                 ->first();

                            // SyS Gen. Date calculation
                              $delv_date2=$order_a->order_delivery_date;            
                              $date2=date_create($delv_date2);
                              $GDD2=date_format($date2,"Y/m/d");
                              $lead_tole2= $tna->lead_days+$tna->tolerance_days; 
                              $yy2=date('Y-m-d', strtotime('-'.$lead_tole2.' day', strtotime($GDD2)));
                          ?>
                          @foreach($tnaction AS $taction)

                            <?php 

                                  // Offset day 

                                      $libray2=DB::table('mr_tna_template_to_library AS l')
                                        ->select([
                                                  'l.id',
                                                  'l.offset_day'                                               
                                              ])
                                      
                                      ->where('l.mr_tna_template_id', $taction->tmid)
                                      ->where('l.id','>', $taction->lib_id)
                                      ->get();  
                                                      

                                      $offset2=$taction->offset_day;

                                       foreach($libray2 AS $lib2){
                                         $offset2+=$lib2->offset_day;
                                       }
                                  //

                                  if($taction->tna_temp_logic=="OK to Begin"){                                 
                                      $offset1=$taction->offset_day;
                                      $sg_date1=date('d/m/Y', strtotime('-'.$offset2.' day', strtotime($yy2)));                             
                                  }

                                  if($taction->tna_temp_logic=="DCD or FOB"){

                                      $offset1=$taction->offset_day;
                                      $sg_date1=date('d/m/Y', strtotime('-'.$offset2.' day', strtotime($GDD2))); 
                                  }

                              ?>
                           
                            <tr style="text-align:center">
                                <td><?=$i ?>
                                <input type='hidden' value='{{$taction->tlid}}' name='lib_id[]'>
                                </td>
                                <td><?= $taction->tna_lib_action; ?></td>
                                <td><?= $sg_date1; ?></td>
                                <td width='30%'><input type='date'name='actualdate[]' value='{{$taction->actual_date}}' ></td>                                
                                <td width='20%'><input type='text' name='remark[]' value='{{$taction->remarks}}'></td>
                            </tr>
                               @php( $i=$i+1)
                          @endforeach  
                        </tbody>
                    </table>      
                  </div>

                  <div class="clearfix form-actions col-md-9"> 
                      <div class="col-md-offset-3 "> 
                         <input type='hidden' value='{{$tna->id}}' name='tna_id'>
                          <a class="btn btn-info generatetna" type="submit">
                              <i class="ace-icon fa fa-check bigger-110"></i> Generate TNA
                          </a>
                          <button class="btn btn-info" type="submit">
                              <i class="ace-icon fa fa-check bigger-110"></i> Update
                          </button>
                          <button class="btn" type="reset">
                              <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                          </button>
                      </div>
                  </div>      
              </form> 
          </div><!--- /. Row Form 1---->
        <div class="panel panel-default"></div>
      </div><!-- /.page-content -->
    </div>
</div>
<!--  <script type='text/javascript'>
         $(document).ready(function() {
            //option A
            $("form").submit(function(e){
                alert('submit intercepted');
                e.preventDefault(e);
            });
        });
</script> -->
<script type="text/javascript">

$(document).ready(function(){ 
  //$("#confirm_date").val(moment().format("YYYY-MM-DD")); 

 /// Generate TNA

     var basedon = $(".generatetna");
     var action_place=$(".tna-generate");
      basedon.on("click", function(){ 

        // Action Element list
        $.ajax({
            url : "{{ url('merch/time_action/tna_generate') }}",
            type: 'get',
            data: {
              order_id: $("#order_id").val(),             
              confirm_date:$("#confirm_date").val(),
              lead_days:$("#lead_days").val(),
              tolerance_days:$("#tolerance_days").val(),
              tna_type: $("#tna_type").val(),
              ok_to_begin:$("#ok_to_begin").val(),
              rev_ok_to_begin:$("#rev_ok_to_begin").val()
            },
             
            success: function(data)
            {
                action_place.html(data);
            },
            error: function()
            {
                alert('failed...');
            }
        });

    });
/// 

});
</script>
@endsection