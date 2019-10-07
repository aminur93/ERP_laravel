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
                <li class="active">Bank Acceptance Entry Preview</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Commercial <small><i class="ace-icon fa fa-angle-double-right"></i>Bank Acceptance Entry Preview</small></h1>
            </div>
                @include('inc/message')
            <a href="{{url('commercial/bank/bank_acceptance_entry')}}" class="btn btn-sm btn-info pull-left">Back</a>

            <div class="space-10"></div>
            
            <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="dataTables_bankAcceptance" class="table table-striped table-bordered">
                            <thead>
                                <th>SE. NO.</th>
                                <th>Transport Doc</th>
                                <th>Transport Doc Date</th>
                                <th>Value</th>
                                <th>Bill Ex Rec Date</th>
                                <th>Acceptance Date</th>
                                <th>Negotiation Date</th>
                                <th>Bank Bill No</th>
                                <th>Discre Date</th>
                                <th>Discre Acp Date</th>
                                <th>Days</th>
                                <th>Due Date/Dates</th>
                                <th>Exchange Rate</th>
                                <th>Acceptance Comm</th>
                                <th>Libor Rate</th>
                                <th>Due Provided By</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if($bank_acceptance_imp_data)
                                 @foreach($bank_acceptance_imp_data as $bai)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                            @foreach($bai->bnk_acc_entry as $bnkentry)
                                              {{ $bnkentry->transp_doc_no1 }}
                                            @endforeach
                                        </td>
                                        <td> 
                                            @foreach($bai->bnk_acc_entry as $bnkentry)
                                              {{ $bnkentry->transp_doc_date }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($bai->bnk_acc_entry as $bnkentry)
                                              {{ $bnkentry->value }}
                                            @endforeach
                                        </td>
                                        <td>{{ $bai->bill_ex_rec_date }}</td>
                                        <td>{{ $bai->acceptance_date }}</td>
                                        <td>{{ $bai->negotiation_date }}</td>
                                        <td>{{ $bai->bank_bill_no }}</td>
                                        <td>{{ $bai->discre_date }}</td>
                                        <td>{{ $bai->discre_acp_date }}</td>
                                        <td>{{ $bai->days }}</td>
                                        <td>

                                            @foreach($bai->due_dates_all as $dates)
                                                  {{$dates->due_date}}
                                                  @if($loop->index+1 < sizeof($bai->due_dates_all))
                                                  ,
                                                  @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $bai->exchange_rate }}</td>
                                        <td>{{ $bai->acceptance_comm }}</td>
                                        <td>{{ $bai->libor_rate }}</td>
                                        <td>{{ $bai->due_provided_by }}</td>
                                        <td>
                                            <div class="btn-group">
                                               <a href="{{ url('commercial/bank/bank_acceptance_entry_edit/'.$bai->id) }}" class='btn btn-xs btn-primary'><i class="fa fa-pencil"></i></a>
                                               <a href="{{ url('commercial/bank/bank_acceptance_entry_delete/'.$bai->id) }}" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                            </div>
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
         $('#dataTables_bankAcceptance').DataTable({
            "scrollY": true,
            "scrollX": true
            });
        
    });
</script>
@endsection