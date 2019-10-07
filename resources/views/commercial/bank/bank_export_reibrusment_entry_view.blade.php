@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Commercial</a>
                </li>
                <li> 
                    <a href="#">Bank</a>   
                </li> 
                <li class="active">Export Reimbursement Entry Preview</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Export Reimbursement Entry Preview</small></h1>
            </div>
                {{-- @include('inc/message') --}}

     {{--        <a href="{{url('commercial/bank/bank_acceptance_entry')}}" class="btn btn-sm btn-info pull-left">Back</a>
 --}}
            <div class="space-10"></div>
            
            <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="reibursement_table" class="table table-striped table-bordered">
                            <thead>
                                <th>SE. NO.</th>
                                <th>File No</th>
                                <th>Bill No</th>
                                <th>Value</th>
                                <th>Invoice No</th>
                                <th>Transport Doc Date</th>
                                <th>Diffrence (Days)</th>
                                <th>Date</th>
                                <th>Reimburesment Amount($)</th>
                                <th>Exchange Rate</th>
                                <th>F.C Amount($), %</th>
                                <th>CD. Amount($), %</th>
                                <th>A. Tax Amount BDT, %</th>
                                <th>TAX at Source BDT, %</th>
                                <th>Central Fund Account BDT, %</th>
                                <th>Discount Interest USD</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                               @if($exp_reimb_data)
                                 @foreach($exp_reimb_data as $rmb)
                                    <tr>
                                       <td>{{$loop->index+1}}</td>
                                       <td>{{$rmb->file_no}}</td>
                                       <td>{{$rmb->bill_no}}</td>
                                       <td>{{$rmb->value}}</td>
                                       <td>{{$rmb->invoice_no}}</td>
                                       <td>{{$rmb->transp_doc_date}}</td>
                                       <td>{{$rmb->diff_days}}</td>
                                       <td>{{ $rmb->date }}</td>
                                       <td>{{ $rmb->reimburse_amount }}</td>
                                       <td>{{ $rmb->exchange_rate }}</td>
                                       <td>{{ $rmb->fc_amount_dollar }},<br>{{$rmb->fc_amount_percent }}%</td>
                                       <td>{{ $rmb->cd_amount_dollar }}, <br>{{$rmb->cd_amount_percent }}%</td>
                                       <td>{{ $rmb->a_tax_amount_bdt }}, <br>{{$rmb->a_tax_percent }}%</td>
                                       <td>{{ $rmb->tax_source_bdt }}, <br>{{$rmb->tax_source_bdt_percent }}%</td>
                                       <td>{{ $rmb->central_fund }}, <br>{{$rmb->central_fund_percent }}%</td>
                                       <td>{{ $rmb->discount_interest_usd }}</td>

                                       <td>
                                            <div class="btn-group">
                                                   <a href="{{ url('commercial/bank/exp_reimbursement_edit/'.$rmb->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                                   <a href="{{ url('commercial/bank/exp_reimbursement_delete/'.$rmb->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                            </div>
                                       </td>
                                    </tr> 
                                  @endforeach
                                @else
                                No data.   
                                @endif
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
<script>
        $(document).ready(function() {
            $('#reibursement_table').DataTable({
            "scrollY": 300,
            "scrollX": true
            });
    } );
</script>

@endsection