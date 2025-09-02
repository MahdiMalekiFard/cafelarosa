@push('css')
    @if(isRtl())
        <link href="/assets/plugins/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css"/>
    @else
        <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    @endif
@endpush
@push('js')
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script>
        datatable = $('.table').DataTable({
            searching: (typeof datatable_searching != 'undefined') ? datatable_searching : true,
            responsive: (typeof datatable_responsive != 'undefined') ? datatable_responsive : true,
            searchDelay: (typeof datatable_searchDelay != 'undefined') ? datatable_searchDelay : 500,
            stateSave: (typeof datatable_stateSave != 'undefined') ? datatable_stateSave : false,
            processing: (typeof datatable_processing != 'undefined') ? datatable_processing : true,
            serverSide: (typeof datatable_serverSide != 'undefined') ? datatable_serverSide : true,
            ajax: datatable_url,
            @if(isRtl())
            language: {
                url: '/assets/plugins/custom/datatables/DataTable_Persian.json'
            },
            @endif
            pageLength: (typeof datatable_pageLength != 'undefined') ? datatable_pageLength : 10,
            columns: datatable_columns
        });
        document.querySelector('[data-kt-customer-table-filter="search"]')
            .addEventListener('keyup', function (e) {
                datatable.search(e.target.value).draw();
            });

        $('#datatableFiltersForm').on('submit', function (e) {
            e.preventDefault();
            var filters = {};
            $(this).serializeArray().forEach(function (item, index) {
                filters[item.name] = item.value;
            });
            updateDatatable(datatable, datatable_url, filters, false);
        });
    </script>
@endpush
<x-admin.widget.card title="{{@$title}}" desc="{{@$desc}}" cardType="table" :type="$type??'dark'" class="card-flush">
    @if(count($actions??[]))
        @slot('actions')
            <div class="btn-group">
                @foreach($actions??[] as $name=>$href)
                    <a href="{{$href}}" @conditionalNavigate(wire:navigate) class="btn btn-secondary btn-active-primary fw-bolder px-4">{{$name}}</a>
                @endforeach
            </div>
        @endslot
    @endif

    <div class="col-md-6 col-sm-12">
        @if ($search??true==true)
            <div class="d-flex align-items-center position-relative my-1">
                {{loadSvg('assets/media/icons/duotune/general/gen021.svg','svg-icon svg-icon-1 position-absolute ms-6')}}
                <input type="text" data-kt-customer-table-filter="search"
                       class="form-control form-control-solid w-250px ps-15" placeholder="{{__('datatable.search')}}"/>
            </div>
        @endif
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="d-flex justify-content-md-end justify-content-sm-start" data-kt-customer-table-toolbar="base">
            @if (@$export)
                <button type="button" class="btn btn-light-dark me-3" data-kt-customer-table-filter="export"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom"
                        title="{{__('datatable.export_data')}}">
                    {{loadSvg('assets/media/icons/duotune/arrows/arr078.svg','svg-icon svg-icon-2')}}
                </button>
            @endif
            @if (@$import)
                <button type="button" class="btn btn-light-dark me-3" data-kt-customer-table-filter="import"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom"
                        title="{{__('datatable.import_data')}}">
                    {{loadSvg('assets/media/icons/duotune/arrows/arr091.svg','svg-icon svg-icon-2')}}
                </button>
            @endif
            @if (@$filters)
                <livewire:admin.shared.advance-filter :filters="$filters"/>
            @endif
            {{@$customFilter}}
        </div>
    </div>

    <div class="table-responsive">
        <table id="{{$id??'myTable'}}" class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0" style="text-align-last:@if(isRtl())right @else left @endif">
                @foreach($rows as $row)
                    <th>{{$row}}</th>
                @endforeach
            </tr>
            </thead>
        </table>
    </div>
</x-admin.widget.card>

