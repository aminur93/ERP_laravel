@extends('merch.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Merchandising </a>
                </li> 
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Style & Library </a>
                </li> 
                <li class="active"> Style Details</li>
            </ul><!-- /.breadcrumb -->
        </div>


        <div class="page-content">  
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="space-6"></div>

                    <div class="row" id="print">
                        <div class="col-sm-12">
                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-large">
                                    <h3 class="widget-title blue lighter"> 
                                       Style & Libary <small><i class="ace-icon fa fa-angle-double-right"></i>   Style Details  </small>
                                    </h3> 
                                    <div class="widget-toolbar hidden-480">
                                        <a href="#">
                                            <i class="ace-icon fa fa-print fa-2x" onclick="printMe('print')"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <table class="style-details-table">
                                                    <tr>
                                                        <th>Production Type</th><td>{{ $style->stl_order_type }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Buyer</th><td>{{ $style->b_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product Type</th><td>{{ $style->prd_type_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product Name</th><td>{{ $style->stl_product_name }}</td>
                                                    </tr> 
                                                    <tr>
                                                        <th>SMV/pc</th><td>{{ $style->stl_smv }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Operation</th><td> @foreach($operations as $operation) <?php echo $operation->opr_name; ?>/ @endforeach</td>
                                                    </tr> 
                                                </table> 
                                            </div><!-- /.col -->

                                            <div class="col-sm-4"> 
                                                <table class="style-details-table">
                                                    <tr>
                                                        <th>Style No</th><td>{{ $style->stl_no }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Garments Type</th><td>{{ $style->gmt_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Description</th><td>{{ $style->stl_description }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>CM/pc</th><td>{{ $style->stl_cm }}</td>
                                                    </tr> 
                                                    <tr>
                                                        <th>Special Machine</th><td> @foreach($machines as $machine) <?php echo $machine->spmachine_name; ?>/ @endforeach</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sample Type</th><td> @foreach($samples as $sample) <?php echo $sample->sample_name; ?>/ @endforeach</td>
                                                    </tr>
                                                </table>
                                            </div><!-- /.col -->

                                            <div class="col-sm-4"> 
                                                <table class="style-details-table">
                                                    <tr>
                                                        <th>Short Code</th><td>{{ $style->stl_code }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Size Group</th><td>{{ $style->prdsz_group }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Season</th><td>{{ $style->se_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Wash/pc</th><td>{{ $style->stl_wash }}</td>
                                                    </tr> 
                                                </table>
                                            </div><!-- /.col -->
                                        </div><!-- /.row --> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script type="text/javascript">
function printMe(divName)
{ 
    var myWindow=window.open('','','width=800,height=800');
    myWindow.document.write(document.getElementById(divName).innerHTML); 
    myWindow.document.close();
    myWindow.focus();
    myWindow.print();
    myWindow.close();
}
</script>
@endsection