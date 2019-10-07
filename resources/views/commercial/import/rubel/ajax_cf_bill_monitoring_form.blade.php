<div class="col-sm-12">
    <legend>C&F Bill Monitoring Form</legend>
    <form class="form-horizontal" role="form" method="post" action="{{ url('commercial/import/cf_bill_monitoring_save') }}">
        {{ csrf_field() }}
        <div class="row">
            <!-- C&F Bill Monitoring Form -->
            <table class="table">
                <thead>
                    <tr>
                        <th>File No</th>
                        <th>Buyer</th>
                        <th>Value</th>
                        <th>Package</th>
                        <th>Examine Date</th>
                        <th>Assessment Date</th>
                        <th>Factory Arrival</th>
                        <th>C&F Bill No</th>
                        <th>C&F Bill Date</th>
                        <th>C&F Bill Amount</th>
                        <th>Import No</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($dataList) > 0)
                        @foreach($dataList as $k => $data)
                            <tr>
                                <td>
                                    {{-- hidden field --}}
                                    <input type="hidden" name="id[{{$k}}]" value="{{ $data->bill_monitor_id }}">
                                    <input type="hidden" name="cm_imp_data_entry_id[{{$k}}]" value="{{ $data->cm_data_entry_id }}">
                                    <input type="text" id="file_no" name="file_no" placeholder="" value="{{ $data->file_no }}" class="col-xs-12 form-control" readonly="readonly" />
                                </td>
                                <td>
                                    <input type="text" id="buyer_id" name="buyer_id" placeholder="" value="{{ isset($buyerList[$data->b_id])?$buyerList[$data->b_id]:'' }}" class="col-xs-12 form-control" readonly="readonly" />
                                </td>
                                <td>
                                    <input type="text" id="value" name="value" placeholder="" value="{{ $data->value }}" class="col-xs-12 form-control" readonly="readonly" />
                                </td>
                                <td>
                                    <input type="text" id="package" name="package" placeholder="" value="{{ $data->package }}" class="col-xs-12 form-control" readonly="readonly"/>
                                </td>
                                <td>
                                    <input type="text" id="examini_date" name="examini_date" placeholder="" value="{{ $data->examine_date }}" class="col-xs-12 form-control" readonly="readonly"/>
                                </td>
                                <td>
                                    <input type="text" id="asse_date" name="asse_date" placeholder="" value="{{ $data->assess_date }}" class="col-xs-12 form-control" readonly="readonly"/>
                                </td>
                                <td>
                                    <input type="text" id="factory_arr" name="factory_arr" placeholder="" value="{{ '' }}" class="col-xs-12 form-control" readonly="readonly"/>
                                </td>
                                <td>
                                    <input type="text" id="imp_cnf_bill_no" name="imp_cnf_bill_no[{{$k}}]" placeholder="" value="{{ $data->imp_cnf_bill_no != NULL?$data->imp_cnf_bill_no:'' }}" class="col-xs-12 form-control"/>
                                </td>
                                <td>
                                    <input type="text" id="imp_cnf_bill_date" name="imp_cnf_bill_date[{{$k}}]" placeholder="" value="{{ $data->imp_cnf_bill_date != NULL?$data->imp_cnf_bill_date:'' }}" class="col-xs-12 form-control datepicker"/>
                                </td>
                                <td>
                                    <input type="text" id="imp_cnf_bill_amount" name="imp_cnf_bill_amount[{{$k}}]" placeholder="" value="{{ $data->imp_cnf_bill_amount != NULL?$data->imp_cnf_bill_amount:'' }}" class="col-xs-12 form-control"/>
                                </td>
                                <td>
                                    <input type="text" id="imp_no" name="imp_no" placeholder="" value="{{ $data->imp_code }}" class="col-xs-12 form-control" readonly="readonly"/>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-center">No Data Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @if(count($dataList))
                <!-- SUBMIT -->
                <div class="col-sm-12">
                    <div class="space-4"></div>
                    <div class="wizard-actions">
    					<button class="btn btn-prev" type="reset">
    						<i class="ace-icon fa fa-undo bigger-110"></i> Reset
    					</button>
    					<button class="btn btn-success" type="submit">
    						<i class="ace-icon fa fa-check bigger-110"></i> {{ $data->bill_monitor_id!=''?'Update':'Save' }}
                        </button>
    				</div>
                </div>
            @endif
        </div>
    </form>
</div>
<script type="text/javascript">
    $('.datepicker').datetimepicker({
        showClose: true,
        showTodayButton: true,
        dayViewHeaderFormat: "YYYY MMMM",
        format: "YYYY-MM-DD",
        minDate:false
    });
</script>
