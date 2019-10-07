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
                <li class="active">Forward Sales Entry Preview</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Forward Sales Entry Preview</small></h1>
            </div>
                @include('inc/message')
        </div>
         
            {{-- <div class="row"> --}}
                    <div class="col-sm-12 table-responsive">
                        <table id="forward_sales_table" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th rowspan="2" >SE. NO.</th>
                                <th rowspan="2" >Booking Date</th>
                                <th rowspan="2" >Buying Bank</th>
                                <th rowspan="2" >Forward Amount</th>
                                <th rowspan="2" >Sales Done</th>
                                <th rowspan="2" >Exchange Rate</th>
                                <th rowspan="2" >Maturity Satrt</th>
                                <th rowspan="2" >Maturity End</th>
                                <th rowspan="2" >Remarks</th>

                                <th colspan="3" style="text-align: center;">Withdraw</th>
                                <th colspan="3" style="text-align: center;">Encashment</th>
                                
                                <th rowspan="2">Action</th>
                              </tr>
                              <tr>
                                  <th >File No</th>
                                  <th >Account Type</th>
                                  <th >Withdraw Amount</th>
                                  <th >Encashment date</th>
                                  <th >Amount</th>
                                  <th >Balance</th>
                              </tr>
                            </thead>

                            <tbody>
                                @if($forward_sales_master)
                                 @foreach($forward_sales_master as $data)
                                 <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$data->booking_date}}</td>
                                    <td>{{$data->bank }}</td>
                                    <td>{{$data->forward_amnt }}</td>
                                    <td>{{$data->sales_done }}</td>
                                    <td>{{$data->exchange_rate }}</td>
                                    <td>{{$data->maturity_window_start }}</td>
                                    <td>{{$data->maturity_window_end }}</td>
                                    <td>{{$data->remarks }}</td>

                                    <td>
                                        @foreach($data->child1 as $child1)
                                            {{$child1->file}}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($data->child1 as $child1)
                                            {{$child1->account_type}}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($data->child1 as $child1)
                                            {{$child1->withdrawal_amnt}}<br>
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach($data->child2 as $child2)
                                            {{$child2->encashment_date}}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($data->child2 as $child2)
                                            {{$child2->amount}}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($data->child2 as $child2)
                                            {{$child2->balance}}<br>
                                        @endforeach
                                    </td>
                                    
                                    <td>
                                         <div class="btn-group">
                                                   <a href="{{ url('commercial/bank/bank_forward_sales_entry_edit/'.$data->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                                   <a href="{{ url('commercial/bank/bank_forward_sales_entry_delete/'.$data->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                            </div>
                                    </td>
                                </tr>
                                @endforeach 
                                   
                                @else
                                There is no data.
                                @endif
                                

                            </tbody>
                             
                        </table>
                    </div>
            {{-- </div>  --}}
            {{-- row end for table --}}


    </div> {{-- main content inner end --}}
</div>  {{-- main content end --}}

<script type="text/javascript">
    $(document).ready(function() {
        //Showing data table
         $('#forward_sales_table').DataTable({
            "scrollY": true,
            "scrollX": true
            });
        
    });
</script>

@endsection
