@extends('commercial.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
			<div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Commercial </a>
                </li> 
                <li>
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Setup</li>
            </ul><!-- /.breadcrumb -->
            </div>
    </div>
    <div class="page-content">
			<div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i>Setup</small></h1>
            </div>
 	@include('inc/message')
<!--Scrolling to specific setup--->
        <div class="row">
              <div class="col-sm-4">
                <select class="col-xs-12 goto_portion" >
                    <option value="Pi_type_div">PI Type</option>
                    <option value="Bank_div">Bank</option>
                    <option value="Machine_div">Machine </option>
                    <option value="LcType_div">L/C Type </option>
                    <option value="Lc_period_div">L/C Period </option>
                    <option value="Item_div">Item </option>
                    <option value="Port_div">Port </option>
                    <option value="Vessel_div">Vessel </option>
                    <option value="Agent_div">Agent </option>
                    <option value="CashIncentive_div">Cash Incentive </option>
                    <option value="PaymentType_div">Payment Type </option>
                    <option value="Category_div">Category No </option>
                    <option value="Section_div">Section </option>
                    <option value="Hub_div">Hub </option>
                    <option value="Passbook_div">Passbook </option>
                    <option value="Insurance_div">Insurance </option>
                    <option value="Period_div">Period </option>
                    <option value="From_date_div">From Date </option>
                    <option value="Inco_term_div">Inco Term </option>

                </select>
              </div>
        </div>


        <!----PI Type--------------------->
            <div id="Pi_type_div">
               

              <div class="row">
                <!-- Display Erro/Success Message -->
                       
                        {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">PI Type</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/pistore", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="pi_name" > PI Type<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="pi_name" id="pi_name" placeholder="PI Type" class="col-xs-12" data-validation="required length custom" data-validation-length="1-59"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">

                            <h5 class="page-header">PI Type List</h5>
                            <table id="dataTables-pitype" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>PI Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($pitype)
                                    @foreach($pitype as $pi)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $pi->pi_type_name }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/pi_edit/'.$pi->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/pi_delete/'.$pi->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

              </div>
            </div>
        <!----PI Type End--------------------->
        <div class="space-4"></div>

        <!--------------------Bank-------------------->
            <div id="Bank_div">
             

              <div class="row">
                  <div class="col-sm-6">
                      <h5 class="page-header">Bank</h5>
                       
                                {{ Form::open(["url"=>"commercial/setup/bankstore", "class"=>"form-horizontal"]) }}
                                  <div class="form-group">

                                        <label class="col-sm-3 control-label no-padding-right align-left" for="bank_name" >Bank Name<span style="color:red">&#42;</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-43" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$">
                                        </div>

                                        </div>
                                  

                                <div class="form-group">

                                          <label class="col-sm-3 control-label no-padding-right align-left" for="bank_short_code">Short Code<span style="color: red">&#42;</span></label>

                                          <div class="col-sm-9">
                                            <input type="text" name="bank_short_code" id="bank_short_code" placeholder="Bank Short Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-59" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                          </div>
                                    </div>  
                                    <div class="form-group">

                                          <label class="col-sm-3 control-label no-padding-right align-left" for="bank_swift_code">Bank Swift Code<span style="color: red">&#42;</span></label>

                                          <div class="col-sm-9">
                                            <input type="text" name="bank_swift_code" id="bank_swift_code" placeholder="Bank Swift Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-59" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                          </div>
                                    </div>

                                    <div id="accno">
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right align-left" for="acc_no">Account No<span style="color: red">&#42;</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="acc_no[]" id="acc_no" placeholder="Enter account no" class="col-xs-9" data-validation="required length custom" data-validation-length="1-59"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />

                                            <div class="col-sm-3 form-group col-xs-3">
                                            <button type="button" class="btn btn-sm btn-success AddBtn_bnk">+</button>
                                            <button type="button" class="btn btn-sm btn-danger RemoveBtn_bnk">-</button>
                                            </div>

                                        </div>
                                      </div>
                                      
                                    </div>

                        <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right align-left" for="bank_address1" >Address 1<span style="color: red">&#42;</span> </label>

                                          <div class="col-sm-9">
                                            <textarea name="bank_address1" class="form-control" id="bank_address1" placeholder="Enter" data-validation="required length" data-validation-length="0-255" placeholder="Enter"></textarea>
                                          </div>
                                    </div> 

                                    <div class="form-group">
                                          <label class="col-sm-3 control-label no-padding-right align-left" for="bank_address2" >Address 2<span style="color: red">&#42;</span> </label>

                                          <div class="col-sm-9">
                                            <textarea name="bank_address2" class="form-control" id="bank_address2" placeholder="Enter" data-validation="required length" data-validation-length="0-255" placeholder="Enter"></textarea>
                                          </div>
                                    </div> 

                                      <div class="clearfix form-actions">
                                        <div class="col-md-offset-3 col-md-9"> 
                                            <button class="btn btn-info" type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i> Add
                                             </button>

                                            &nbsp; &nbsp; &nbsp;
                                            <button class="btn" type="reset">
                                               <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                            </button>
                                        </div>
                                    </div>



                                </form>


                  </div>

                  <div class="col-sm-6">

                            <h5 class="page-header">Bank List</h5>
                            <table id="dataTables-bank" class="table table-striped table-bordered">
                                  <thead>
                                      <tr>
                                        <th>Se No.</th>
                                          <th>Bank Name</th>
                                          <th>Short Code</th>
                                          <th>Swift Code</th> 
                                          <th>Acc No</th>
                                          <th>Add 1</th>
                                          <th>Add 2</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                   <tbody>
                                    @if($bank)
                                     @foreach($bank as $bnk)
                                     <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $bnk->bank_name }}</td>
                                        <td>{{ $bnk->short_code }}</td>
                                        <td>{{ $bnk->swift_code }}</td>
                                       <td>  
                                        @foreach($bnk->accno AS $bacc)

                                          {{ $bacc->account_no }} <br>
                                        
                                          @endforeach
                                      </td>
                                      <td> {{ $bnk->address_1 }} </td>
                                      <td> {{ $bnk->address_2 }} </td>

                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/bank_edit/'.$bnk->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/bank_delete/'.$bnk->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                   </tbody>
                            </table>

                  </div>
                </div>
                {{-- Row end --}}
            </div>
        <!--------------------Bank End---------------->
        <div class="space-4"></div>
        <!--------------------Machine Start----------->
           <div id="Machine_div">
            

             <div class="row">
                          <!-- Display Erro/Success Message -->

                        <div class="col-sm-6">
                          <h5 class="page-header">Machine Type</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/machinestore", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="Machine_name" > Machine Type<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="Machine_name" id="Machine_name" placeholder="Enter Type Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-127"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div> 
                        
                              <div id="manufacturer-entry">
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="Manufacturer_name" > Manufacturer Name<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="Manufacturer_name[]" id="Manufacturer_name" placeholder="Enter  Name" class="col-xs-9" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>

                                      <div class="form-group col-xs-3 col-sm-3">
                                             <button type="button" class="btn btn-sm btn-success AddBtn_mcn">+</button>
                                             <button type="button" class="btn btn-sm btn-danger RemoveBtn_mcn">-</button> 
                                      </div>     
                                  </div>
                                </div> 
                             </div>   
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                                <!-- /.row --> 
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <h5 class="page-header">MachineType List</h5>
                            <table id="dataTables-machine" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Machine Type</th>
                                        <th>Manufacturer</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($machine)
                                    @foreach($machine as $mcn)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                        {{ $mcn->type_name }}</td>
                                        <td>   
                                            @foreach($mcn->manufacturer AS $mcfr)

                                            {{ $mcfr->manufacturer_name }}<br>
                                        
                                            @endforeach</td>

                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/machine_edit/'. $mcn->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/machine_delete/'.$mcn->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                </div>
                {{-- Row end --}}
           </div>
        <!--------------------Machine End------------->
        <div class="space-4"></div>
        <!-------------L/C Type Start----------------->
          <div id="LcType_div">
            

             <div class="row">
                <div class="col-sm-6 ">
                  <h5 class="page-header">L/C Type</h5>
                  {{Form::open(['url'=>'commercial/setup/lcstore',"class"=>"form-horizontal"] )}}
                        <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right align-left" for="lc_type" >L/C Type<span style="color: red">&#42;</span> </label>
                           <div class="col-sm-9">
                            <input type="text" name="lc_type" id="lc_type" placeholder="Enter L/C Type Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/> 
                           </div>
                           
                        </div>
                        {{-- submitting --}}
                         <div class="clearfix form-actions">
                                        <div class="col-md-offset-3 col-md-9"> 
                                            <button class="btn btn-info" type="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i> Add
                                            </button>

                                            &nbsp; &nbsp; &nbsp;
                                            <button class="btn" type="reset">
                                                <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                            </button>
                                        </div>
                                 </div>

                    </form>


                </div>

                  <div class="col-sm-6 ">
                    <h5 class="page-header">L/C Type List</h5>
                    <table id="dataTables-lctype" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL. NO.</th>
                                            <th>L/C Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($lctype)
                                        @foreach($lctype as $lc)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $lc->lc_type_name }}</td>
                                            <td>
                                             <div class="btn-group">
                                                <a href="{{ url('commercial/setup/lc_edit_1/'. $lc->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                                <a href="{{ url('commercial/setup/lc_delete/'.$lc->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                             </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                  
                </div>
                
              </div>
          </div>
        <!-------------L/C Type End----------------->
        <div class="space-4"></div>

        <!------------L/C Period----------------------->
        <div id="Lc_period_div">
          

          <div class="row">
                  <div class="col-sm-6 ">
                    <h5 class="page-header">L/C Period</h5>
                    {{Form::open(['url'=>'commercial/setup/lcperiodstore',"class"=>"form-horizontal"] )}}
                    
              {{--          <div class="form-group">
                       <label class="col-sm-3 control-label no-padding-right align-left" for="lc_type" >L/C Type<span style="color: red">&#42;</span> </label>
                         <div class="col-sm-9">
                        <select class="col-sm-12" name="lc_type" id="lc_type">

                          @if($lctype)
                          <option>Select an L/C Type</option>
                            @foreach($lctype as $lc)
                              <option>{{$lc->lc_type_name}}</option>
                            @endforeach 
                          @else
                            <option>There is no L/C Type</option> 
                          @endif
                          

                        </select>
                        
                        </div>
                        </div>   --}}

                          <div class="form-group">
                             <label class="col-sm-3 control-label no-padding-right align-left" for="lc_period" >L/C Period<span style="color: red">&#42;</span> </label>
                             <div class="col-sm-9">
                              <input type="number" name="lc_period" id="lc_period" placeholder="Enter L/C Period (Days)" class="col-xs-12" data-validation="required length custom" data-validation-length="1-11" />  
                             </div>
                             
                          </div>
                          {{-- submitting --}}
                           <div class="clearfix form-actions">
                                          <div class="col-md-offset-3 col-md-9"> 
                                              <button class="btn btn-info" type="submit">
                                                  <i class="ace-icon fa fa-check bigger-110"></i> Add
                                              </button>

                                              &nbsp; &nbsp; &nbsp;
                                              <button class="btn" type="reset">
                                                  <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                              </button>
                                          </div>
                                   </div>

                      </form>


                  </div>

                    {{-- Table to Show --}}
                    <div class="col-sm-6 ">
                      <h5 class="page-header">L/C Type with Period List</h5>
                      <table id="dataTables-lcperiod" class="table table-striped table-bordered">
                                      <thead>
                                          <tr>
                                              <th>SL. NO.</th>
                                              {{-- <th>L/C Type</th> --}}
                                              <th>L/C Period</th>
                                              <th>Change Periods</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @if($lcperiod)
                                          @foreach($lcperiod as $lcp)
                                          <tr>
                                              <td>{{ $loop->index+1 }}</td>
                                              {{-- <td>{{ $lcp->lc_type_name }}</td> --}}
                                              <td>{{ $lcp->lc_period_days }}</td>
                                              <td>
                                               <div class="btn-group">
                                                  <a href="{{ url('commercial/setup/lc_period_edit_1/'. $lcp->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                                  <a href="{{ url('commercial/setup/lc_period_delete/'.$lcp->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                               </div>
                                              </td>
                                          </tr>
                                          @endforeach
                                          @endif
                                      </tbody>
                                  </table>
                    
                  </div>
                  
               </div>
        </div>
              
        <!------------L/C Period End------------------->
        <div class="space-4"></div>

        <!-------------Item(FOC) Start----------------->
        <div id="Item_div">
          

          <div class="row">
            <div class="col-sm-6 ">
              <h5 class="page-header">Item(FOC)</h5>
              {{Form::open(['url'=>'commercial/setup/itemstore',"class"=>"form-horizontal"] )}}
                    <div class="form-group">
                       <label class="col-sm-3 control-label no-padding-right align-left" for="item_name" >Item Name<span style="color: red">&#42;</span> </label>
                       <div class="col-sm-9">
                        <input type="text" name="item_name" id="item_name" placeholder="Enter Item Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/> 
                       </div>
                       
                    </div>
                    {{-- submitting --}}
                     <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                             </div>

                </form>


            </div>

              <div class="col-sm-6 ">
                <h5 class="page-header">Item List</h5>
                <table id="dataTables-item" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Item Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($item)
                                    @foreach($item as $itm)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $itm->cm_item_name}}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/item_edit_1/'. $itm->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/item_delete/'.$itm->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
              
            </div>
            
          </div>
        </div>
        <!-------------Item(FOC) End----------------->
        <div class="space-4"></div>

        <!-------------Port Start----------------->
        <div id="Port_div">
          

            <div class="row">
                  <div class="col-sm-6 ">
                    <h5 class="page-header">Port</h5>
                    {{Form::open(['url'=>'commercial/setup/portstore',"class"=>"form-horizontal"] )}}
                    <div class="form-group">
                       <label class="col-sm-3 control-label no-padding-right align-left" for="country_id" >Country<span style="color: red">&#42;</span> </label>
                       <div class="col-sm-9">
                        <select class="col-sm-12" name="country_id" id="country_id">

                          @if($country)
                          <option>Select a country</option>
                            @foreach($country as $ctry)
                              <option value="{{$ctry->cnt_id}}">{{$ctry->cnt_name}}</option>
                            @endforeach 
                          @else
                            <option>There is no country to select</option>  
                          @endif
                          

                        </select>
                        
                       </div>
                    </div>  
                    <div  id="port_and_address" >
                            <div class="form-group ">
                              <div class= "col-sm-9">
                                <div class="row ">
                                  <label class="col-sm-4 control-label no-padding-right align-left" for="port_name" >Port Name<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-8">
                             <input type="text" name="port_name[]" id="port_name" placeholder="Enter Port Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>  
                              </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="row ">
                                  <label class="col-sm-4 control-label no-padding-right align-left" for="port_address" >Address<span style="color: red">&#42;</span> </label>
                           <div class="col-sm-8">
                             <input type="text" name="port_address[]" id="port_address" placeholder="Enter Address" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/> 
                               </div>
                                </div>
                          </div>
                          <div class="col-sm-3">
                              <button type="button" class="btn btn-sm btn-success AddBtn_port">+</button>
                                      <button type="button" class="btn btn-sm btn-danger RemoveBtn_port">-</button>
                          </div>  
                    
                            </div>
                    </div>
                          {{-- submitting --}}
                      <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                         <button class="btn btn-info" type="submit">
                                          
                                              <i class="ace-icon fa fa-check bigger-110"></i> Add
                                         </button>
                            &nbsp; &nbsp; &nbsp;
                                         <button class="btn" type="reset">
                                              <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                         </button>
                                    </div>
                          </div>
                      

                    </form>
                  </div>
                  {{-- Table to show --}}
                  <div class="col-sm-6 ">
                      <h5 class="page-header">Item List</h5>
                      <table id="dataTables-ports" class="table table-striped table-bordered">
                                      <thead>
                                          <tr>
                                              <th>SL. NO.</th>
                                              <th>Port Name</th>
                                              <th>Country</th>
                                              <th>Adress</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @if($ports)
                                          @foreach($ports as $port)
                                          <tr>
                                              <td>{{ $loop->index+1 }}</td>
                                              <td>{{ $port->port_name }}</td>
                                              <td>{{ $port->country_name}}</td>
                                              <td>{{ $port->address}}</td>

                                              <td>
                                               <div class="btn-group">
                                                  <a href="{{ url('commercial/setup/port_edit_1/' . $port->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                                  <a href="{{ url('commercial/setup/port_delete/' . $port->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                               </div>
                                              </td>
                                          </tr>
                                          @endforeach
                                          @else
                                          No Data Found
                                          @endif
                                      </tbody>
                                  </table>
                    
                  </div>
              </div>
        </div>
        <!-------------Port End------------------->
        <div class="space-4"></div>
        <!-------------Vessel Start----------------->
        <div id="Vessel_div">
              <div class="row">
                

                     <div class="col-sm-6">
                         <h5 class="page-header">Vessel</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/vesselstore", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="vessel_name" > Vessel Name<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="vessel_name" id="vessel_name" placeholder="Enter Vessel Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-60"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div> 
                        
                              <div id="voyage-entry">
                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="voyage_no" >Voyage No<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="voyage_no[]" id="voyage_no" placeholder="Enter voyage no" class="col-xs-9" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>

                                      <div class="form-group col-xs-3 col-sm-3">
                                             <button type="button" class="btn btn-sm btn-success AddBtn_mcn">+</button>
                                             <button type="button" class="btn btn-sm btn-danger RemoveBtn_mcn">-</button> 
                                      </div>     
                                  </div>
                                </div> 
                             </div>   
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                                <!-- /.row --> 
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <h5 class="page-header">Vessel List</h5>
                            <table id="dataTables-vessel" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Vessel Name</th>
                                        <th>Voyage No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($vessel)
                                    @foreach($vessel as $vsl)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                          {{ $vsl->vessel_name }}
                                        </td>
                                        <td>   
                                            @foreach($vsl->voyages AS $voy)

                                              {{ $voy->voyage_name }}<br>
                                        
                                            @endforeach
                                        </td>

                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/vessel_edit/'. $vsl->id ) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/vessel_delete/'. $vsl->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

            </div>
            {{-- Row end --}}
        </div>
        <!-------------Vessel End------------------->
        <div class="space-4"></div>

        <!-------------Agent Start----------------->
        <div id="Agent_div">
          

              <div class="row">   
                <div class="col-sm-6">
                         <h5 class="page-header">Agent</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/agentstore", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                   <label class="col-sm-3 control-label no-padding-right align-left" for="agent_name" > Agent Name<span style="color: red">&#42;</span> </label>
                     
                                  <div class="col-sm-3">
                                    <input type="text" name="agent_name" id="agent_name" placeholder="Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>

                                  <label class="col-sm-3 control-label no-padding-right align-left" for="agent_type" > Agent Type<span style="color: red">&#42;</span> </label>
                                  <div class="col-sm-3">
                                     <select id="agent_type" name="agent_type" class="col-xs-12">
                                      <option >Select a Type</option>
                                      <option value="C&F">C&F</option>
                                      <option value="Export">Export</option>
                                     </select>
                                  </div>
                           
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-3 control-label no-padding-right align-left" for="contact_person" >Contact Person<span style="color: red">&#42;</span> </label>
                                   <div class="col-sm-9">
                                     <textarea name="contact_person" class="form-control" id="contact_person" placeholder="Enter" data-validation="required length" data-validation-length="1-145">Enter </textarea>
                                     </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-sm-3 control-label no-padding-right align-left" for="agent_address" >Address<span style="color: red">&#42;</span> </label>
                                   <div class="col-sm-9">
                                     <textarea name="agent_address" class="form-control" id="agent_address" placeholder="Enter" data-validation="required length" data-validation-length="1-145">Enter</textarea>
                                     </div>
                                </div>

                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>

                              {{-- End Form --}}
                              </form> 
                </div>
                <div class="col-sm-6">
                    <h5 class="page-header">Agent List</h5>
                      <table id="dataTables-agent" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Agent Name</th>
                                        <th>Agent Type</th>
                                        <th>Contact Person</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($agent)
                                     @foreach($agent as $agt)
                                     <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $agt->agent_name}}</td>
                                        <td>{{ $agt->agent_type}}</td>
                                        <td>{{ $agt->contact_person}}</td>
                                        <td>{{ $agt->address}}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/agent_edit/'. $agt->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/agent_delete/'.$agt->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                     </tr>
                                     @endforeach
                                   
                                    @endif
                                </tbody>
                            </table>
                  
                </div>
              </div>
        </div>
             
        <!-------------Agent End------------------->
        <div class="space-4"></div>
        <!-------------Cash Incentive Start------------------->
        <div id="CashIncentive_div">
          
              <div class="row">
            {{-- Form --}}
            <div class="col-sm-6">
              <h5 class="page-header">Cash Incentive Status</h5>
              {{Form::open(['url'=>'commercial/setup/incentivestore',"class"=>"form-horizontal"] )}}
              <div class="form-group">
                 <label class="col-sm-3 control-label no-padding-right align-left" for="country" >Country<span style="color: red">&#42;</span> </label>
                 <div class="col-sm-9">
                  <select class="col-sm-12" name="country" id="country">

                    @if($country)
                    <option>Select a country</option>
                      @foreach($country as $ctry)
                        <option value="{{$ctry->cnt_id}}">{{$ctry->cnt_name}}</option>
                      @endforeach 
                    @else
                      <option>There is no country to select</option>  
                    @endif
                  </select>
                 </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right align-left" for="incentive" >Incentive<span style="color: red">&#42;</span> </label>
                 <div class="col-sm-9">
                  <select class="col-sm-12" name="incentive" id="incentive">
                    <option>Select Status</option>
                    <option>Yes</option>
                    <option>No</option> 
                  </select>
                 </div>
                
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right align-left" for="type" >Type<span style="color: red">&#42;</span> </label>
                <div class="col-sm-9">
                <input type="text" name="type" id="type" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                </div>
              </div>
                  {{-- Submitting --}}
                         <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>
                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>

              </form>
            </div>
            {{-- Table --}}
            <div class="col-sm-6">
              <h5 class="page-header">Agent List</h5>
                      <table id="dataTables-csinc" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Country</th>
                                        <th>Incentive</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($cash_incen)
                                     @foreach($cash_incen as $cs)
                                     <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $cs->country_name}}</td>
                                        <td>{{ $cs->incentive}}</td>
                                        <td>{{ $cs->type}}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/incentive_edit/'. $cs->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/incentive_delete/'.$cs->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                     </tr>
                                     @endforeach
                                   
                                    @endif
                                </tbody>
                            </table>
            </div>
          </div>
        </div>
        <!-------------Cash Incentive End--------------------->
        <div class="space-4"></div>

        <!-------------Payment Type Start--------------------->
        <div id="PaymentType_div">
          

              <div class="row">
                <!-- Display Erro/Success Message -->
                        {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">Payment Type</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/paymenttype_store", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="payment_type" > Payment Type<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="payment_type" id="payment_type" placeholder="Payment Type" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">
                  <h5 class="page-header">Payment Type List</h5>
                            <table id="dataTables-payType" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Payment Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($pay_type)
                                    @foreach($pay_type as $pt)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $pt->type_name }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/paymenttype_edit/'.$pt->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/paymenttype_delete/'.$pt->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

              </div>
        </div>
        <!-------------Payment Type End----------------------->
        <div class="space-4"></div>

        <!-------------Category No start----------------------->
        <div id="Category_div">
          
              <div class="row">
                <!-- Display Erro/Success Message -->
                        {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">Category No</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/category_no_store", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="category_name" >Name<span style="color: red">&#42;</span> </label>
                                  <div class="col-sm-9">
                                    <input type="text" name="category_name" id="category_name" placeholder="Category Name" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="category_code" >Code<span style="color: red">&#42;</span> </label>
                                  <div class="col-sm-9">
                                    <input type="text" name="category_code" id="category_code" placeholder="Category Code" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45" />
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">
                  <h5 class="page-header">Category List</h5>
                            <table id="dataTables-categoryNo" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Category</th>
                                        <th>Code</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($category_no)
                                    @foreach($category_no as $cat)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $cat->cat_no_name }}</td>
                                        <td>{{ $cat->cat_no_code }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/category_no_edit/'.$cat->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/category_no_delete/'.$cat->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

            </div>
        </div>
        <!-------------Category No end------------------------->
        <div class="space-4"></div>
        <!------------------------------Section Strat---------------------->
        <div id="Section_div">
            

                <div class="row">
                        {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">Section</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/section_store", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="section" > Section Name<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="section" id="section" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>
                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">
                  <h5 class="page-header">Section List</h5>
                            <table id="dataTables-section" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Section</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($section)
                                    @foreach($section as $sec)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $sec->section_name }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/section_edit/'.$sec->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/section_delete/'.$sec->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

              </div>
        </div>
        <!------------------------------Section End------------------------>
        <div class="space-4"></div>
        <!------------------------------Hub Strat------------------------------>
        <div id="Hub_div">
          

              <div class="row">
                        {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">Hub</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/hub_store", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="hub" > Hub Name<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="hub" id="hub" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>
                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">
                  <h5 class="page-header">Hub List</h5>
                            <table id="dataTables-hub" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Hub Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($hub)
                                    @foreach($hub as $hb)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $hb->hub_name }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/hub_edit/'.$hb->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/hub_delete/'.$hb->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

          </div>
        </div>
        <!------------------------------Hub End------------------------------>
        <div class="space-4"></div>
        <!------------------------------Passbook Start------------------------------>
        <div id="Passbook_div" >
          

              <div class="row">
              
                        {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">Passbook</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/passbook_store", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="volume_no" >Volume No<span style="color: red">&#42;</span> </label>
                                  <div class="col-sm-9">
                                    <input type="text" name="volume_no" id="volume_no" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="page_no" >Page No<span style="color: red">&#42;</span> </label>
                                  <div class="col-sm-9">
                                    <input type="text" name="page_no" id="page_no" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">
                  <h5 class="page-header">Passbook List</h5>
                            <table id="dataTables-passbook" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Voulme No</th>
                                        <th>Page No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($passbook)
                                    @foreach($passbook as $pb)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $pb->volume_no }}</td>
                                        <td>{{ $pb->page_no }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/passbook_edit/'.$pb->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/passbook_delete/'.$pb->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

              </div>
        </div>
        <!------------------------------Passbook End-------------------------------->
        <div class="space-4"></div>
        <!------------------------------Insurance Start-------------------------------->
        <div id="Insurance_div">
         

               <div class="row">                {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">Insurance</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/insurance_store", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="company_name" >Company Name<span style="color: red">&#42;</span> </label>
                                  <div class="col-sm-9">
                                    <input type="text" name="company_name" id="company_name" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="code" >Code<span style="color: red">&#42;</span> </label>
                                  <div class="col-sm-9">
                                    <input type="text" name="code" id="code" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">
                  <h5 class="page-header">Insurance List</h5>
                            <table id="dataTables-insurance" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Company</th>
                                        <th>Code</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($insurance)
                                    @foreach($insurance as $ins)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $ins->company_name }}</td>
                                        <td>{{ $ins->code }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/insurance_edit/'.$ins->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/insurance_delete/'.$ins->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

                </div>
        </div> 
        <!------------------------------Insurance End---------------------------------->
        <div class="space-4"></div>
        <!------------------------------Period End---------------------------------->
        <div id="Period_div">
              <div class="row">
                        {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">Period</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/period_store", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="period" > Period Name<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="period" id="period" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>
                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">
                  <h5 class="page-header">Hub List</h5>
                            <table id="dataTables-period" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Period Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($period)
                                    @foreach($period as $pd)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $pd->period_name }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/period_edit/'.$pd->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/period_delete/'.$pd->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

          </div>
        </div>
        <!------------------------------Period End------------------------------>
        <div class="space-4"></div>
        <!------------------------------From Date Of Start------------------------------>
        <div id="From_date_div">
              <div class="row">
                        {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">From Date</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/from_date_store", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="from_date" > From Date<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="date" name="from_date" id="from_date" placeholder="Enter" class="col-xs-12" data-validation="required" />
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>
                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">
                  <h5 class="page-header">From Dates List</h5>
                            <table id="dataTables-from_date" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>From Date </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($from_date_data)
                                    @foreach($from_date_data as $fd)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $fd->from_date }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/from_date_edit/'.$fd->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/from_date_delete/'.$fd->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

          </div>
        </div>
        <!------------------------------From Date Of Start------------------------------>

        <!------------------------------Inco Term Of Start------------------------------>
        <div id="Inco_term_div">
              <div class="row">
                        {{-- 1st column --}}
                         <div class="col-sm-6">  
                            <h5 class="page-header">Inco Term</h5>
                            <!-- PAGE CONTENT BEGINS --> 
                            {{ Form::open(["url"=>"commercial/setup/inco_term_store", "class"=>"form-horizontal"]) }}

                                <div class="form-group">
                                  <label class="col-sm-3 control-label no-padding-right align-left" for="inco_term" >Inco Term Name<span style="color: red">&#42;</span> </label>

                                  <div class="col-sm-9">
                                    <input type="text" name="inco_term" id="inco_term" placeholder="Enter" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                                  </div>
                                </div>  
         
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9"> 
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i> Add
                                        </button>
                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                        </button>
                                    </div>
                                </div>
                               
                            </form> 
                            <!-- PAGE CONTENT ENDS -->
                         </div>
                         <!-- /.col end -->
                         <div class="col-sm-6">
                  <h5 class="page-header">Inco Term List</h5>
                            <table id="dataTables-inco_term" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL. NO.</th>
                                        <th>Term Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($inco_term_data)
                                    @foreach($inco_term_data as $fd)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $fd->name }}</td>
                                        <td>
                                         <div class="btn-group">
                                            <a href="{{ url('commercial/setup/inco_term_edit/'.$fd->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                            <a href="{{ url('commercial/setup/inco_term_delete/'.$fd->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                         </div>

          </div>
        </div>
        <!------------------------------From Date Of Start------------------------------>




 <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse display"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a>
    </div>
</div>

<!---Script for the page content---->
<script type="text/javascript">
	$(document).ready(function() {
          //Goto Portion from dropdown
            $('body').on('change','.goto_portion', function(){
                var portion = $(this).val();
                console.log(portion);
                var elmnt = document.getElementById(portion);
                console.log(elmnt);

                 $('html, body').animate({
                      scrollTop: $(elmnt).offset().top
                  }, 1000);
            });  
    

		//Showing data table
		$('#dataTables-pitype').DataTable();
		$('#dataTables-bank').DataTable();
		$('#dataTables-machine').DataTable();
		$('#dataTables-lctype').DataTable();
		$('#dataTables-lcperiod').DataTable();
		$('#dataTables-item').DataTable();
		$('#dataTables-ports').DataTable();
		$('#dataTables-vessel').DataTable();
		$('#dataTables-agent').DataTable();
		$('#dataTables-csinc').DataTable();
    $('#dataTables-payType').DataTable();
    $('#dataTables-categoryNo').DataTable();
    $('#dataTables-section').DataTable();
    $('#dataTables-hub').DataTable();
    $('#dataTables-passbook').DataTable();
    $('#dataTables-insurance').DataTable();
    $('#dataTables-period').DataTable();
    $('#dataTables-from_date').DataTable();
    $('#dataTables-inco_term').DataTable();

//For multiple bank account
	var data1=$("#accno").html();
    	    $('body').on('click', '.AddBtn_bnk', function(){
    	    $("#accno").append(data1);
   		 });

  	$('body').on('click', '.RemoveBtn_bnk', function(){
  		$(this).parent().parent().parent().remove();
  		});

 //For more machine manuf..
    var data = $("#manufacturer-entry").html();
    $('body').on('click', '.AddBtn_mcn', function(){
        $("#manufacturer-entry").append(data);
    });

    $('body').on('click', '.RemoveBtn_mcn', function(){
        $(this).parent().parent().parent().remove();
    });


//For more port entry..
    var data2 = $("#port_and_address").html();
    $('body').on('click', '.AddBtn_port', function(){
        $("#port_and_address").append(data2);
    });

    $('body').on('click', '.RemoveBtn_port', function(){
        $(this).parent().parent().remove();
    });

 //For more voyage..
    var data3 = $("#voyage-entry").html();
    $('body').on('click', '.AddBtn_mcn', function(){
        $("#voyage-entry").append(data3);
    });

    $('body').on('click', '.RemoveBtn_mcn', function(){
        $(this).parent().parent().parent().remove();
    });

  

  });
</script>
<!-------Script End---------------->
@endsection