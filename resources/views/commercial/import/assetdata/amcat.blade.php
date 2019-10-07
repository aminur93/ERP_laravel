<table id="bomTable" class="table table-bordered table-striped table-highlight" >
    <thead>
    <th>Machine Type</th>
    <th>Model No</th>
    <th>Description</th>
    <th>Section</th>
    <th>Quantity</th>
    <th>Uom</th>
    <th>Unit Price</th>
    <th>Pi Value</th>
    <th>Shipped Qty</th>
    <th>Action</th>
    </thead>

    <tbody class="addRemovees min-font">
    @foreach($pi as $p)
        <tr id="assetbom0" class="no-padding">
            <td>
                <select name="machine_type" id="machine_type" class="form-control">
                    <option>Select</option>
                    @foreach($cm_machine as $cm)
                        <option value="{{$cm->id}}" @if($p->cm_machine_type_id == $cm->id) selected @endif>{{ $cm->type_name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="assetbom[]" value="assetbom0" class="pirow" />
                <input type="hidden" value="{{ $p->id }}" name="cm_pi_asset_description_id[]" class="form-control" />
                <input type="hidden" value="{{ $p->cm_pi_asset_id }}" name="cm_pi_asset_id[]" class="form-control" />
            </td>


            <td>
                <input type="text" name="model_no" value="{{ $p->model_no }}" class="form-control">
            </td>

            <td>
                <input type="text" value="{{ $p->description }}" name="description" id="description" class="form-control" />
            </td>


            <td>
                <select name="section" id="section" class="form-control">
                    <option value="">Select</option>
                    @foreach($cm_section as $cs)
                        <option value="{{ $cs->id }}" @if($p->cm_section_id = $cs->id) selected @endif>{{ $cs->section_name }}</option>
                    @endforeach
                </select>
            </td>

            <td>
                <input type="text" value="{{ $p->qty }}" name="description" id="description" class="form-control" />
            </td>


            <td>
                <?php
                $uomList = array(
                    "Millimeter" => "Millimeter",
                    "Centimeter" => "Original",
                    "Meter" => "Meter",
                    "Inch" => "Inch",
                    "Feet" => "Feet",
                    "Yard" => "Yard",
                    "Piece" => "Piece"
                );
                ?>

                <select name="uom" id="uom" class="form-control">
                    <option value="">Select</option>
                    @foreach($uomList as $um)
                        <option value="{{ $um }}" @if($p->uom == $um) selected @endif>{{ $um }}</option>
                    @endforeach
                </select>
            </td>

            <td>
                <input type="text" value="{{ $p->unit_price }}" name="description" id="description" class="form-control" />
            </td>


            <td>
                <input type="text" name="pi_value" id="pi_values" class="form-control g_input" value="{{ $p->qty * $p->unit_price }}" />
            </td>


            <td>
                <input type="text" name="shipped_qty[]" id="shipped_qty" class="form-control" />
            </td>


            <td>
                <button type="button" class="btn btn-xs btn-success AddBtns">+</button>
                <button type="button" class="btn btn-xs btn-danger RemoveBtns">-</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

