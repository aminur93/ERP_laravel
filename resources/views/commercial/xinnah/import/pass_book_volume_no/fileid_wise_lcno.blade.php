
<option value=""> - select - </option>
@foreach($getLcNo as $lcno)
<option value="{{$lcno->lc_no}}">{{$lcno->lc_no}}</option>
@endforeach
