<x-admin.layout.master
    :stack="[]"
    :title="trans('general.page.create.page_title',['model'=>trans('profile.model')])">


    <!--begin::Navbar-->
{{--    @include('admin.pages.profile.show-partials.navbar',['user'=>$user,'profile'=>$profile])--}}
    <!--end::Navbar-->

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="overview" role="tabpanel">
            @include('admin.pages.profile.show-partials.pages.overview',['user'=>$user,'profile'=>$profile])
        </div>
        <div class="tab-pane fade" id="settings" role="tabpanel">
            @include('admin.pages.profile.show-partials.pages.settings',['user'=>$user,'profile'=>$profile])
        </div>
        <div class="tab-pane show active" id="personal_information" role="tabpanel">
            @include('admin.pages.profile.show-partials.pages.personal-information',['user'=>$user,'profile'=>$profile])
        </div>
    </div>


</x-admin.layout.master>
