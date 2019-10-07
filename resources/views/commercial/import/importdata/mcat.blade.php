 <table id="bomTable" class="table table-bordered table-striped table-highlight">
        <thead>
        <th>Category</th>
        <th>Description</th>
        <th>Color</th>
        <th>Articel</th>
        <th>Composition</th>
        <th>Construction</th>
        <th>Uom</th>
        <th>Consumption</th>
        <th>Extra</th>
        <th>Total Qty</th>
        <th>Unit Price</th>
        <th>Currency</th>
        <th>Pi Qty</th>
        <th>Pi Value</th>
        <th>Shipped Qty</th>
        <th>Action</th>
        </thead>

        <tbody class="addRemovees min-font">
        @foreach($pi as $p)
        <tr id="pibom0" class="no-padding">
            <td>
                <select name="category" id="category" class="form-control">
                    <option>Select</option>
                    @foreach($mr_category as $mc)
                        <option value="{{$mc->mcat_id}}" @if($p->mr_material_category_mcat_id == $mc->mcat_id) selected @endif>{{ $mc->mcat_name }}</option>
                    @endforeach
                    </select>
                <input type="hidden" name="pibom[]" value="pibom0" class="pirow" />
                <input type="hidden" value="{{ $p->id }}" name="id[]" class="form-control" />
                <input type="hidden" value="{{ $p->cm_pi_master_id }}" name="cm_pi_master_id[]" class="form-control" />


            </td>


            <td>
                <input type="text" value="{{ $p->description }}" name="description" id="description" class="form-control" />

            </td>


            <td>
                <select name="color" id="color" class="form-control">
                    <option value="">Select</option>
                    @foreach($mr_color as $mc)
                        <option value="{{ $mc->clr_id }}" @if($p->mr_material_color_clr_id == $mc->clr_id) selected @endif>{{ $mc->clr_name }}</option>
                        @endforeach
                </select>
            </td>


            <td>
                <select name="article" id="article" class="form-control">
                    <option value="">Select</option>
                    @foreach($mr_art as $ma)
                        <option value="{{ $ma->id }}" @if($p->mr_article_id = $ma->id) selected @endif>{{ $ma->art_name }}</option>
                        @endforeach
                </select>
            </td>


            <td>
                <select name="composition" id="composition" class="form-control">
                    <option value="">Select</option>
                    @foreach($mr_comp as $mco)
                        <option value="{{ $mco->id }}" @if($p->mr_composition_id = $mco->id) selected @endif>{{ $mco->comp_name }}</option>
                    @endforeach
                </select>
            </td>

            <td>
                <select name="construction" id="construction" class="form-control">
                    <option value="">Select</option>
                    @foreach($mr_const as $mcon)
                        <option value="{{ $mcon->id }}" @if($p->mr_construction_id = $mcon->id) selected @endif>{{ $mcon->construction_name }}</option>
                    @endforeach
                </select>
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
                <input type="text" value="{{ $p->consumption }}" name="consumption" id="consumption" class="form-control" />
            </td>


            <td>
                <input type="text" value="{{ $p->extra }}" name="extra" id="extra" class="form-control" />
            </td>


            <td>
                <input type="text" value="{{ $p->total_qty }}" name="t_qty" id="t_qty" class="form-control" />
            </td>


            <td>
                <input type="text" value="{{ $p->unit_price }}" name="u_price" id="u_price" class="form-control" />
            </td>


            <td>
                <input type="text" value="{{ $p->currency }}" name="currency" id="currency" class="form-control" />
            </td>


            <td>
                <input type="text" value="{{ $p->pi_qty }}" name="pi_qty" id="pi_qty" class="form-control" />
            </td>


            <td>
                <input type="text" name="pi_value" id="pi_values" class="form-control g_input" value="{{ $p->total_qty * $p->unit_price }}" />
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

