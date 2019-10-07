<option value=""> - select - </option>
@foreach($supplier as $value)
<option value="{{$value->sup_id}}">{{$value->sup_name}}</option>
@endforeach
