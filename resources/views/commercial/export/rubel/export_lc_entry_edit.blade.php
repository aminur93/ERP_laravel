@extends('commercial.index')
@push('css')
    <style type="text/css">
        .section_label {
            background: aliceblue;
        }
    </style>
@endpush
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
                    <a href="#"> Export </a>
                </li>
                <li class="active"> Edit Export L/C Entry </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Export <small><i class="ace-icon fa fa-angle-double-right"></i> Edit Export L/C Entry </small></h1>
            </div>
            <!-- 1st ROW -->
            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div id="selectOne"></div> 
            </div>
            <form action="{{ url('commercial/export/exportLcEntry_update/'.$exportLcEntry->id) }}" method="post">
                {{ csrf_field() }}
                <div class="col-sm-offset-2 col-sm-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="bank_sub_date" > Invoice No</label>
                        <div class="col-sm-8">
                            <input type="text" id="bank_sub_date" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->invoice_no:'' }}" class="col-xs-12 form-control" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="bank_sub_date" > Unit</label>
                        <div class="col-sm-8">
                            <input type="text" id="bank_sub_date" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->hr_unit_name:'' }}" class="col-xs-12 form-control" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                <br>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="bank_sub_date" > Bank Submission Date</label>
                        <div class="col-sm-8">
                            <input type="text" id="bank_sub_date" name="bank_sub_date" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->bank_sub_date:'' }}" class="col-xs-12 form-control datepicker"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="courier_name" > Courier Name (Bank)</label>
                        <div class="col-sm-8">
                            <input type="text" id="courier_name" name="courier_name" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->courier_name:'' }}" class="col-xs-12 form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="courier_no" > Courier No (Bank)</label>
                        <div class="col-sm-8">
                            <input type="text" id="courier_no" name="courier_no" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->courier_no:'' }}" class="col-xs-12 form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="courier_date" > Courier Date</label>
                        <div class="col-sm-8">
                            <input type="text" id="courier_date" name="courier_date" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->courier_date:'' }}" class="col-xs-12 form-control datepicker"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="bill_no" > Bill No</label>
                        <div class="col-sm-8">
                            <input type="text" id="bill_no" name="bill_no" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->bill_no:'' }}" class="col-xs-12 form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="negotiation_date" > Nagotiation Date</label>
                        <div class="col-sm-8">
                            <input type="text" id="negotiation_date" name="negotiation_date" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->negotiation_date:'' }}" class="col-xs-12 form-control datepicker"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="exp_proceed_rcv_date" > Export Proceed Rcv Date</label>
                        <div class="col-sm-8">
                            <input type="text" id="exp_proceed_rcv_date" name="exp_proceed_rcv_date" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->exp_proceed_rcv_date:'' }}" class="col-xs-12 form-control datepicker"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding" for="type_discrepancy" > Type of Discrepancy</label>
                        <div class="col-sm-8">
                            <input type="text" id="type_discrepancy" name="type_discrepancy" placeholder="" value="{{ isset($exportLcEntry)?$exportLcEntry->type_discrepancy:'' }}" class="col-xs-12 form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <br>
                    <label class="col-sm-4"></label>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script type="text/javascript">
    	
    </script>
@endpush