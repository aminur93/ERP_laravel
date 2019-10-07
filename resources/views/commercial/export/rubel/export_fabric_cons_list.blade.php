@extends('commercial.index')
@push('css')
	<style type="text/css">
		.divborder {
			border: 1px solid lightgray;
    		padding: 12px 0px;
		}
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
                <li class="active"> Export Fabric Consumption List </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-header">
            <h1>Export <small><i class="ace-icon fa fa-angle-double-right"></i> Export Fabric Consumption List </small></h1>
        </div>
        <div class="col-centered">
          <table class="table">
            <thead>
              <tr>
                <th>File No</th>
                <th>Unit</th>
                <th>Invoice No</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datas as $data)
              <tr>
                <td>{{$data->cm_file_id}}</td>
                <td>{{$data->hr_unit}}</td>
                <td>{{$data->invoice_no}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>

</div>
<!-- Display Erro/Success Message -->
@include('inc/message')
  <div class="main-content">

  </div>

@endsection
