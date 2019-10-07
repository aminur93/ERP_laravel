@extends('commercial.index')
@section('content')
	<div class="main-content">
		@push('css')
			<style>
				.section-head-h4 {
				    background-color: #bce8f1;
				    color: #31708f;
				    padding: 10px;
				}
			</style>
		@endpush
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
	                <li class="active"> Cash Incentive List </li>
	            </ul><!-- /.breadcrumb -->
	        </div>

	        <div class="page-content">
	            <div class="page-header">
	                <h1>Export <small><i class="ace-icon fa fa-angle-double-right"></i> Cash Incentive List </small></h1>
	            </div>

	        </div><!-- /.page-content -->
          <div class="col-centered col-md-12">
            <table class="table table-bordered">
              <thead>
                <tr>
									<th>SL no</th>
                  <th>File No</th>
									<th>Status</th>
									<th>Unit</th>
									<th>Incentive Per</th>
									<th>Bank Submit Date</th>
									<th>Invoice</th>
                </tr>
              </thead>
              <tbody>
								@foreach ($datas as $v)
									 <tr>
										 @if(isset($vals[$v->id]))
											 <td rowspan="{{ $vals[$v->id] }}">{{ $v->id}}</td>
											 <td rowspan="{{ $vals[$v->id] }}">{{ $v->file_no }}</td>
											 <td rowspan="{{ $vals[$v->id] }}">{{ $v->incentive }}</td>
											 <td rowspan="{{ $vals[$v->id] }}">{{ $v->hr_unit }}</td>
											 <td rowspan="{{ $vals[$v->id] }}">{{ $v->incentive_percent }}</td>
											 <td rowspan="{{ $vals[$v->id] }}">{{ $v->bank_subm_date }}</td>

											 @php
											   unset($vals[$v->id])
											 @endphp
										 @endif
										 <td>{{ $v->invoice_no }}</td>
									 </tr>

								@endforeach
              </tbody>
            </table>
          </div>
	    </div>
	</div>


@endsection
