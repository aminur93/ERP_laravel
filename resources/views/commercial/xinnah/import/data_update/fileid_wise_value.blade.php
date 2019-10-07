<option value=""> - select - </option>
@foreach($getValues as $getValue)
<option value="{{$getValue->value}}">{{$getValue->value}}</option>
@endforeach