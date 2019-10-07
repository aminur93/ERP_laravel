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
                <li class="active">Import Bill settlement Entry List</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Import Bill Settlement Entry List</small></h1>
            </div>

            <a href="{{url('commercial/bank/import_bill_settlement')}}" class="btn btn-sm btn-info pull-left">Entry Page</a>

            <div class="space-10"></div>
            
            <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="dataTables-importBill" class="table table-striped table-bordered">
                            <thead>
                                <th>ID No.</th>
                                <th>Payment Date</th>
                                <th>Days of Interest</th>
                                <th>Interest Rate</th>
                                <th>Amount ($)</th>
                                <th>Account Type ID</th>
                                <th>Import Data Entry ID</th>
                                
                            </thead>
                           <tbody>
                                @if($imp_bill_settle_data)
                                 @foreach($imp_bill_settle_data as $ibs)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                              {{ $ibs->payment_date }}
                                        </td>
                                        <td>
                                              {{ $ibs->days_interest }}
                                        </td>
                                        <td>
                                              {{ $ibs->interest_rate }}
                                        </td>
                                        <td>
                                              {{ $ibs->amount }}
                                        </td>
                                        <td>
                                              {{ $ibs->cm_acc_type_id }}
                                        </td>
                                        <td>
                                              {{ $ibs->cm_imp_data_entry_id }}
                                        </td>
                                        {{-- <td>
                                            <div class="btn-group">
                                               <a href="{{ url('#'.$ibs->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                               <a href="{{ url('#'.$ibs->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td> --}}
                                    </tr>
                                 @endforeach
                                @endif
                            </tbody> 
                        </table>
                    </div>
            </div>


            {{-- page content end --}}
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        //Showing data table
        $('#dataTables-importBill').DataTable();
    });
</script> 
@endsection