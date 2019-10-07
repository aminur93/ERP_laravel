<div class="row">
    <div class="col-md-12">
        <div class="col-6">
            <div class="card mt-3 tab-card">
                <div class="card-header tab-card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        @php
                            $count = 0;
                        @endphp
                        @foreach($dataGroup as $key => $dg)
                            @php
                                $count += 1;
                            @endphp
                            <li class="nav-item {{ $count==1?'active':'' }}">
                                <a class="nav-link" id="{{ $count }}-tab" data-toggle="tab" href="#{{ $count }}" role="tab" aria-controls="{{ $count }}" aria-selected="true">{{ $key }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent" style="padding: 0;height: 450px;margin-top: 5px;">
                    @php
                        $count = 0;
                    @endphp
                    @foreach($dataGroup as $key => $dg)
                        @php
                            $count += 1;
                        @endphp
                        <div class="tab-pane {{ $count==1?'active':'' }}" id="{{ $count }}" role="tabpanel" aria-labelledby="{{ $count }}-tab">

                            <ul class="checkbox">
                                @foreach($dg as $g)
                                    {{--dd($g);exit;--}}
                                    <li class='col-sm-1'>
                                        <input type='checkbox' class='group-input-size' name="selected_size[]" id="size_{{ $g->id }}" value="{{ $g->id }}" {{ in_array($g->size,$s_id)!==false?'checked="checked':'' }} />
                                        <label for="size_{{ $g->id }}">{{ $g->size }}</label>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
