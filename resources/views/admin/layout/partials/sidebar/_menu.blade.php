@php use App\Enums\CategoryTypeEnum;use App\Enums\RoleEnum; @endphp
    <!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
        <!--begin::Scroll wrapper-->
        <div
            id="kt_app_sidebar_menu_scroll"
            class="scroll-y my-5 mx-3"
            data-kt-scroll="true"
            data-kt-scroll-activate="true"
            data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu"
            data-kt-scroll-offset="5px"
            data-kt-scroll-save-state="true">
            <div
                class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                id="#kt_app_sidebar_menu"
                data-kt-menu="true"
                data-kt-menu-expand="false">

                {{--                @include('admin.layout.partials.sidebar.menu.sub-menu',[--}}
                {{--                'title' => trans('_menu.dashboard'),--}}
                {{--                'icon' => 'fa-solid fa-home fs-2',--}}
                {{--                'route' => '/admin',--}}
                {{--                'exact'=>true,--}}
                {{--            ])--}}
                {{--                @include('admin.layout.partials.sidebar.menu.sub-menu',[--}}
                {{--                    'title' => trans('_menu.profile'),--}}
                {{--                    'icon' => 'fad fa-user fs-2',--}}
                {{--                    'route' => route('admin.profile.show',['profile'=>auth()->user()->profile->id]),--}}
                {{--                    'exact'=>true,--}}
                {{--                    'has_permission' => true--}}
                {{--                ])--}}

                @include('admin.layout.partials.sidebar.menu.menu',[
                    'title' => trans('_menu.user_management'),
                    'icon' => 'fad fa-user fs-2',
                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                    'sub' => [
                        [
                            'title' => trans('_menu.user.all'),
                            'route' => route('admin.user.index'),
                            'exact' => true,
                        ],
                        [
                            'title' => trans('_menu.user.create'),
                            'route' => route('admin.user.create'),
                        ],
                    ],
                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                                    'title' => trans('_menu.blog_management'),
                                    'icon' => 'fad fa-blog fs-2',
                                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                                    'sub' => [
                                        [
                                            'title' => trans('_menu.blog.all'),
                                            'route' => route('admin.blog.index'),
                                        ],
                                        [
                                            'title' => trans('_menu.blog.categories'),
                                            'route' => route('admin.category.index',['type'=>CategoryTypeEnum::BLOG->value]),
                                        ],
                                    ],
                                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                                    'title' => trans('_menu.portfolio_management'),
                                    'icon' => 'fad fa-address-card fs-2',
                                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                                    'sub' => [
                                        [
                                            'title' => trans('_menu.portfolio.all'),
                                            'route' => route('admin.portfolio.index'),
                                        ],
                                        [
                                            'title' => trans('_menu.portfolio.categories'),
                                            'route' => route('admin.category.index',['type'=>CategoryTypeEnum::PORTFOLIO->value]),
                                        ],
                                    ],
                                ])

                @include('admin.layout.partials.sidebar.menu.menu',[
                                    'title' => trans('_menu.menu_management'),
                                    'icon' => 'fa-solid fa-utensils fs-2',
                                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),
                                    'sub' => [
                                        [
                                            'title' => trans('_menu.menu.all'),
                                            'route' => route('admin.menu.index'),
                                        ],
                                        [
                                            'title' => trans('_menu.menu.all_items'),
                                            'route' => route('admin.menu-item.index'),
                                        ],
                                    ],
                                ])

{{--                @include('admin.layout.partials.sidebar.menu.menu',[--}}
{{--                    'title' => trans('_menu.product_interface_management'),--}}
{{--                    'icon' => 'fad fa-shop fs-2',--}}
{{--                    'has_permission' => auth()->user()->hasRole(RoleEnum::ADMIN->value),--}}
{{--                    'sub' => [--}}
{{--                        [--}}
{{--                            'title' => trans('_menu.product_interface.all'),--}}
{{--                            'route' => route('admin.product.index'),--}}
{{--                            'exact' => true,--}}
{{--                        ],--}}
{{--                        [--}}
{{--                            'title' => trans('_menu.product_interface.create'),--}}
{{--                            'route' => route('admin.product.create'),--}}
{{--                        ],--}}
{{--                    ],--}}
{{--                ])--}}

                @include('admin.layout.partials.sidebar.menu.sub-menu',[
                    'title' => trans('_menu.contact'),
                    'icon' => 'fad fa-phone fs-2',
                    'route' => route('admin.contact.index'),
                    'exact'=>true,
                    'has_permission' => true,
                ])

                @include('admin.layout.partials.sidebar.menu.sub-menu',[
                    'title' => trans('_menu.slider'),
                    'icon' => 'fad fa-images fs-2',
                    'route' => route('admin.slider.index'),
                    'has_permission' => true,
                ])

                @include('admin.layout.partials.sidebar.menu.sub-menu',[
                    'title' => trans('_menu.gallery'),
                    'icon' => 'fa-brands fa-envira fs-2',
                    'route' => route('admin.art-gallery.index'),
                    'has_permission' => true,
                ])

{{--                @include('admin.layout.partials.sidebar.menu.sub-menu',[--}}
{{--                    'title' => trans('_menu.service'),--}}
{{--                    'icon' => 'fad fa-toolbox fs-2',--}}
{{--                    'route' => route('admin.service.index'),--}}
{{--                    'has_permission' => true,--}}
{{--                ])--}}

                @include('admin.layout.partials.sidebar.menu.sub-menu',[
                    'title' => trans('_menu.pages'),
                    'icon' => 'fad fa-book-open fs-2',
                    'route' => route('admin.page.index'),
                    'has_permission' => true,
                ])

                @include('admin.layout.partials.sidebar.menu.sub-menu',[
                    'title' => trans('_menu.opinions'),
                    'icon' => 'fad fa-comments fs-2',
                    'route' => route('admin.opinion.index'),
                    'has_permission' => true,
                ])

            </div>
        </div>
        <!--end::Scroll wrapper-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
