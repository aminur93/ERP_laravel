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
                <li class="active">Payment Planning</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Payment Planning View</small></h1>
            </div>

            {{--<a href="{{url('commercial/bank/import_bill_settlement')}}" class="btn btn-sm btn-info pull-left">Entry Page</a>--}}

            <div class="space-10"></div>
            
            <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="payment_planning" class="table table-striped table-bordered">
                            <thead>
                                <th>Entry No</th>
                                <th>Export Data Entry ID</th>
                                <th>Import Data Entry ID</th>
                                <th>Planning Code</th>
                                
                                
                            </thead>
                           <tbody>
                                @if($payment_planning_data)
                                 @foreach($table_data as $td)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                              {{ $td->expfile }}
                                        </td>
                                        <td>
                                              {{ $td->impfile }}
                                        </td>
                                        <td>
                                              {{ $td->planning_code }}
                                        </td>
                                        
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
        $('#payment_planning').DataTable();
    });
</script> 
@endsection