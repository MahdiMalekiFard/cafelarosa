<div class="d-flex align-items-center gap-2 gap-lg-3">
    <div class="m-0">
        <a href="#" @class(['btn btn-light-dark','me-3'=>rtlEnable(),'ms-3'=>!rtlEnable()]) data-kt-menu-trigger="click"
        @if(rtlEnable()) data-kt-menu-placement="bottom-start" @else data-kt-menu-placement="bottom-end" @endif
        >
            <i class="fad fa-filter-list"></i>
        </a>
        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_64b776137cfc4">
            <div class="px-7 py-5">
                <div class="fs-5 text-dark fw-bold">{{__('datatable.advanced_filter')}}</div>
            </div>
            <div class="separator border-gray-200"></div>
            <form id="datatableFiltersForm">
                   <div class="px-7 py-5">
                @foreach($filters as $index=>$filter)
                    @switch($filter['type'])
                        @case('number')
                            <div class="mb-10">
                                <label class="form-label fw-semibold">{{$filter['label']}}:</label>
                                <input class="hidden" type="hidden" name="a_search[{{$index}}][column]" value="{{$filter['key']}}"/>
                                <input class="hidden" type="hidden" name="a_search[{{$index}}][contain]" value="1"/>
                                <div>
                                    <div class="input-group input-group-sm mb-5">
                                        <span class="input-group-text">
                                        <select class="form-select form-select-sm form-select-solid" name="a_search[{{$index}}][operator]">
                                            <option value="="> {{__('datatable.sign.=')}} </option>
                                            <option value=">"> {{__('datatable.sign.>')}}</option>
                                            <option value="<"> {{__('datatable.sign.<')}} </option>
                                            <option value="!"> {{__('datatable.sign.!=')}} </option>
                                        </select>
                                        </span>
                                    <input type="number" class="form-control" name="a_search[{{$index}}][from]"/>

                                </div>
                            </div>
                            @break
                        @case('input')
                            <div class="mb-10">
                                <input class="hidden" type="hidden" name="a_search[{{$index}}][column]" value="{{$filter['key']}}"/>
                                <input class="hidden" type="hidden" name="a_search[{{$index}}][contain]" value="1"/>
                                <input class="hidden" type="hidden" name="a_search[{{$index}}][operator]" value="like"/>
                                 <label class="form-label fw-semibold">{{$filter['label']}}:</label>
                                 <div>
                                     <input type="text" name="a_search[{{$index}}][from]" class="form-control form-select-solid">
                                 </div>
                            </div>
                            @break
                        @case('select')
                            <div class="mb-10">
                                <input class="hidden" type="hidden" name="a_search[{{$index}}][column]" value="{{$filter['key']}}"/>
                                <input class="hidden" type="hidden" name="a_search[{{$index}}][contain]" value="1"/>
                                <input class="hidden" type="hidden" name="a_search[{{$index}}][operator]" value="="/>
                                 <label class="form-label fw-semibold">{{$filter['label']}}:</label>
                                 <div>
                                     <select class="form-select form-select-solid" name="a_search[{{$index}}][from]" data-kt-select2="true" data-close-on-select="true" data-placeholder="Select option" data-allow-clear="true">
                                         <option></option>
                                         @foreach($filter['options'] as $option)
                                              <option value="{{$option['value']}}">{{$option['label']}}</option>
                                         @endforeach
                                     </select>
                                </div>
                            </div>
                            @break
                        @case('in')
                        <div class="mb-10">
                        <input class="hidden" type="hidden" name="a_search[{{$index}}][column]" value="{{$filter['key']}}"/>
                        <input class="hidden" type="hidden" name="a_search[{{$index}}][contain]" value="1"/>
                                <label class="form-label fw-semibold">{{$filter['label']}}:</label>
                                <div>
                                    <select class="form-select form-select-solid" name="a_search[{{$index}}][from][]" multiple="multiple" data-kt-select2="true" data-close-on-select="true" data-placeholder="Select option" data-allow-clear="true">
                                        <option></option>
                                        @foreach($filter['options'] as $option)
                                             <option value="{{$option['value']}}">{{$option['label']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @break
                    @endswitch
                @endforeach


                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">{{__('datatable.reset')}}</button>
                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">{{__('datatable.apply')}}</button>
                </div>

            </div>

        </div>
            </form>

    </div>
</div>
</div>