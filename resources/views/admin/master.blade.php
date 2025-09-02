@php use App\ExtraAttributes\ProfileExtraEnum; @endphp
<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" @if(isRtl()) dir="rtl" direction="rtl" style="direction:rtl;" @endif data-bs-theme="{{auth()->user()->profile->extra_attributes->get(ProfileExtraEnum::THEME->value,'light')}}">
<!--begin::Head-->
<head>
    <base href=""/>
    <title>@yield('title','Metanext')</title>
    <meta charset="utf-8"/>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico"/>
    <link href="/assets/plugins/global/plugins.bundle{{isRtl()?'.rtl':''}}.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style.bundle{{isRtl()?'.rtl':''}}.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/fonts.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css"/>
    @livewireStyles
    @vite(['resources/js/app.js','resources/css/app.css'])
    <!--end::Global Stylesheets Bundle-->
    @stack('css')
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body
        id="kt_app_body"
        data-kt-app-page-loading-enabled="false"
        data-kt-app-page-loading="off"
        data-kt-app-layout="dark-sidebar"
        data-kt-app-header-fixed="true"
        data-kt-app-header-fixed-mobile="true"
        data-kt-app-sidebar-enabled="true"
        data-kt-app-sidebar-fixed="true"
        data-kt-app-sidebar-hoverable="true"
        data-kt-app-sidebar-push-header="true"
        data-kt-app-sidebar-push-toolbar="true"
        data-kt-app-sidebar-push-footer="true"
        class="app-default">
{{--@include('admin.partials.theme-mode._init')--}}
{{--@include('admin.layout.partials._page-loader')--}}
@include('admin.layout._default')
@persist('scrolltop')
    @include('admin.partials._scrolltop')
@endpersist

<!--begin::Modals-->
@include('admin.partials.modals._upgrade-plan')
@include('admin.partials.modals._view-users')
@include('admin.partials.modals.users-search._main')
@include('admin.partials.modals._invite-friends')
<!--end::Modals-->
<!--begin::Javascript-->
<script>
    var hostUrl = 'assets/';        </script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js" data-navigate-once></script>
<script src="/assets/js/scripts.bundle.js" data-navigate-once></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" data-navigate-once></script>
<script src="/assets/plugins/custom/datatables/datatables.bundle.js" data-navigate-once></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="/assets/js/widgets.bundle.js" data-navigate-once></script>
<script src="/assets/js/custom/widgets.js" data-navigate-once></script>
<script src="/assets/js/custom/apps/chat/chat.js" data-navigate-once></script>
<script src="/assets/js/custom/utilities/modals/upgrade-plan.js" data-navigate-once></script>
<script src="/assets/js/custom/utilities/modals/users-search.js" data-navigate-once></script>
<script src="/assets/js/jqBootstrapValidation.js"></script>
<script src="/assets/js/proajax_admin.js" ></script>

@include('sweetalert::alert')
@livewireScripts
<script>
    @if(config('livewire.navigate.enable')===true)
    document.addEventListener('livewire:navigated', () => {
        console.log('livewire:navigated');
        KTComponents.init();
        KTMenu.init = function () {
            KTMenu.createInstances();

            KTMenu.initHandlers();
        };
        KTMenu.init();
    }, { once: true });
    @endif

    jQuery(document).ready(function () {
        const showLoading = function () {
            Swal.fire({
                title: 'در حال بررسی مقادیر، لطفا منتظر بمانید...',
                showDenyButton: false,
                showConfirmButton: false,
                closeOnClickOutside: false,
                allowOutsideClick: false,
                closeOnEsc: false
            });
        };
        $('.table').on('click', '.sa-warning', function (e) {
            e.preventDefault();
            f = $(this).closest('form');
            Swal.fire({
                title: 'آیا از حذف این مورد اطمینان دارید؟',
                text: 'با حذف این مورد دیگر امکان بازگشت وجود ندارد.',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: 'حذف کن',
                denyButtonText: `انصراف`
            }).then((result) => {
                if (result.isConfirmed) {
                    f.submit();
                } else {
                    Swal.fire('عملیات حذف لغو شد.');
                }
            });
        });

        $(document).on('click', '.openDialog', function () {
            Swal.fire(
                $(this).data('title'),
                $(this).data('content'),
                $(this).data('type') ?? null
            );
        });

        // $("#form").submit(function (e) {
        //     e.preventDefault();
        //     e.stopPropagation();
        //     var err_Input = $(this).find('input[aria-invalid=true]');
        //     if (!$(this)[0].checkValidity() || err_Input.length > 0) {
        //         Swal.fire("اخطار", 'لطفا به دقت فرم مد نظر را پر کنید', 'error');
        //         return false;
        //     }
        //     $(this)[0].submit();
        //     showLoading();
        //     return true;
        // });

        $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );


        // try {
        //     var inputList = document.getElementsByClassName("tagify");
        //     for (let i = 0; i < inputList.length; i++) {
        //         new Tagify(inputList[i]);
        //     }
        // } catch (e) {
        // }

        $('input,select,textarea').focus(function () {
            // get selected input error container
            $(this).siblings('.validation-error-message').hide();
        });

    });

    function replaceQueryParam(param, newVal, search) {
        const regex = new RegExp('([?;&])' + param + '[^&;]*[;&]?');
        const query = search.replace(regex, '$1').replace(/&$/, '');
        return (query.length > 2 ? query + '&' : '?') + (newVal ? param + '=' + newVal : '');
    }

    function updateDatatable(datatable, url, filters, pushUrl = true) {
        let updatedApiUrl = url + $.param(filters);
        if (pushUrl) {
            window.history.pushState({path: url}, '', updatedApiUrl);
        }
        datatable.ajax.url(updatedApiUrl).load();
    }

</script>


<!--end::Custom Javascript-->
@stack('js')
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>