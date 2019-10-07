<table id="bomTable" class="table table-bordered table-striped table-highlight pi_{{ $invoiceId }}" >
    <thead>
    <th>PI No.</th>
    <th>PI Date</th>
    <th>Action</th>
    </thead>
    <tbody class="addRemove min-font">
    <tr id="pirow-0" class="no-padding">

        <td style="min-width:75px;">
            <select name="pi_no[]" id="pi_no" class="pi_no form-control">
                <option>Select</option>
                @foreach($cm_pi as $pno)
                    <option value="{{$pno->id}}">{{$pno->pi_no}}</option>
                @endforeach
            </select>
            <input type="hidden" name="rowno[]" value="pirow-0" class="pirow" />
        </td>

        <td style="max-width:122px;">
            <input type="date" name="pidate[]" id="pidate" class="form-control pidate" readonly="readonly" />
        </td>

        <td>
            <button type="button" class="btn btn-xs btn-success AddBtn">+</button>
            <button type="button" class="btn btn-xs btn-danger RemoveBtn">-</button>
        </td>
    </tr>
    </tbody>
</table>

