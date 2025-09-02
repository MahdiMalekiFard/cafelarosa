@php use App\ExtraAttributes\ProfileExtraEnum; @endphp
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
       @persist('header')
        @include('admin.layout.partials._header')
       @endpersist
        <!--begin::Wrapper-->
        <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
            @include('admin.layout.partials._sidebar')
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <!--begin::Content-->
                    <div id="kt_app_content" class="app-content  flex-column-fluid ">
                        <!--begin::Content container-->
                        <div id="kt_app_content_container" @class([
                            "app-container",
                            "container-xxl"=>auth()->user()->profile->extra_attributes->get(ProfileExtraEnum::CONTAINER->value,'boxed')=='boxed',
                            "container-fluid"=>auth()->user()->profile->extra_attributes->get(ProfileExtraEnum::CONTAINER->value,'boxed')=='full'
                            ])>
                            @yield('content')
                        </div>
                        <!--end::Content container-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Content wrapper-->
                @persist('footer')
                    @include('admin.layout.partials._footer')
                @endpersist
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
@include('admin.partials._drawers')