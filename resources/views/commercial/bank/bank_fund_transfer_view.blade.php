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
                <li class="active">Fund Transfer Entry Preview</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Fund Transfer Entry Preview</small></h1>
            </div>
                @include('inc/message')

     {{--        <a href="{{url('commercial/bank/bank_acceptance_entry')}}" class="btn btn-sm btn-info pull-left">Back</a>
 --}}
            <div class="space-10"></div>
            
            {{-- <div class="row"> --}}
                    <div class="col-sm-12 table-responsive">
                        <table id="fund_transfer_table" class="table table-striped table-bordered">
                            <thead>
                                <th>SE. NO.</th>
                                <th>File No</th>
                                <th>Account Type</th>
                                <th>Date</th>
                                <th>Narration</th>
                                <th>Amount</th>
                                <th>Currency</th>
                                <th>Agent</th>
                                <th>Exchange Rate</th>
                                <th>Transfer Ref. File No</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                               @if($fund_trans_data)
                                 @foreach($fund_trans_data as $ftd)
                                    <tr>
                                        <td>{{$loop->index+1 }}</td>
                                        <td>
                                            @foreach($ftd->file as $f)
                                                   {{$f->file_no}} 
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($ftd->acc as $ac)
                                                    {{$ac->acc_type_name}}
                                            @endforeach    
                                        </td>
                                        <td> {{$ftd->date}} </td>
                                        <td> {{$ftd->narration}} </td>
                                        <td> {{$ftd->amount}} </td>
                                        <td> {{$ftd->currency}} </td>
                                        <td>
                                            @foreach($ftd->agent as $ag)
                                                    {{$ag->agent_name}}
                                            @endforeach   
                                        </td>
                                        <td>{{$ftd->exchange_rate}}</td>
                                        <td>
                                            @foreach($ftd->ref_file as $rf)
                                            {{$rf->file_no}}
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @if($ftd->amount < 0)
                                                 ---
                                                @elseif(is_null($ftd->cm_agent_id) && is_null($ftd->exchange_rate) && is_null($ftd->transfer_ref_file_no ) )
                                                    From Reibursement    
                                                @else
                                                   <a href="{{ url('commercial/bank/fund_transfer_from_to_edit/'.$ftd->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                                   <a href="{{ url('commercial/bank/fund_transfer_entry_delete/'.$ftd->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                                 @endif
                                            </div>
                                        </td>
                                    </tr> 
                                  @endforeach   
                                @endif
                               
                            </tbody>
                        </table>
                    </div>
                {{-- </div> --}}
            </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //Showing data table
         $('#fund_transfer_table').DataTable({
            "scrollY": true,
            "scrollX": true
            });
        
    });
</script>
@endsection