<option value=""> - select - </option>
@foreach($getSuppliers as $getSupplier)
<option value="{{$getSupplier->supplier->sup_id}}">{{$getSupplier->supplier->sup_name}}</option>
@endforeach
