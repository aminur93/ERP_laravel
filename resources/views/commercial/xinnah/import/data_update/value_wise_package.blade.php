<option value=""> - select - </option>
@foreach($getPackages as $getPackage)
<option value="{{$getPackage->package}}">{{$getPackage->package}}</option>
@endforeach