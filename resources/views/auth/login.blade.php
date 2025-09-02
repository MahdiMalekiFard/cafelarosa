@extends('auth.master')
@push('js')

@endpush
@push('css')

@endpush

@section('content')
    <x-admin.widget.form
        class="form w-100"
        novalidate
        :action="route('auth.login', ['locale' => app()->getLocale()])"
        :enable_ajax="0"
    >
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">{{__('auth.sign_in')}}</h1>
        </div>

        <x-admin.element.input
            :label="__('auth.email')"
            parent-class="mb-8"
            :placeholder="__('auth.email')"
            type="email"
            name="email"
            required="1"
        />
        <x-admin.element.input
            :label="__('auth.password')"
            parent-class="mb-8"
            :placeholder="__('auth.password')"
            name="password"
            type="password"
            required="1"
        />

        <!--<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">-->
        <!--    <div></div>-->
        <!--    <a href="{{route('auth.forgot-password-view')}}" class="link-primary">{{__('auth.forgot_password')}}</a>-->
        <!--</div>-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <span class="indicator-label">{{__('auth.sign_in')}}</span>
            </button>
        </div>
        <!--<div class="text-gray-500 text-center fw-semibold fs-6">{{__('auth.not_a_member_yet')}}-->
        <!--    <a href="{{route('auth.register-view')}}" class="link-primary">{{__('auth.sign_up')}}</a>-->
        <!--</div>-->
    </x-admin.widget.form>

@endsection
