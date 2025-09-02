<x-admin.layout.master
        :stack="[trans('general.page.index.title',['model'=>trans('slider.model')])=>route('admin.slider.index')]"
        :title="trans('general.page.index.title',['model'=>trans('slider.model')])">

<livewire:admin.pages.static-content />
</x-admin.layout.master>
