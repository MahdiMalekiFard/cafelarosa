@extends('web.layout.main')

@section('content')
    <div class="p-menu">
        <section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-main">
                            <h2 class="title">{{ trans('page.pages.menu.page_title') }}</h2>

                            <ul class="breacrumd">
                                <li><a href="/">{{ trans('home.header.home') }} </a></li>
                                <li>/</li>
                                <li>{{ trans('page.pages.menu.breadcrumb') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="s-menu zingzac">
            <div class="container container-max-width">
                <div class="row">
                    <div class="menu-content">

                        @foreach($menus as $menu)
                            <div class="menu-main {{ $loop->index % 2 === 0 ? 'right' : '' }}">

                                @if($loop->index % 2 === 0)
                                    {{-- IMAGE (left on odd, right on even via .right) --}}
                                    <div class="image" data-aos-duration="1000" data-aos="{{ $loop->index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                                        <img src="{{ $menu?->getFirstMediaUrl('image') }}" alt="">
                                    </div>

                                    {{-- FIRST BUCKETS (stay beside image) --}}
                                    <ul class="menu-list">
                                        <p class="sub-title" data-aos-duration="1000" data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-up' }}">
                                            {{ $menu?->description }}
                                        </p>
                                        <h4 data-aos-duration="1000" data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-up' }}">
                                            {{ $menu?->title }}
                                        </h4>

                                        @foreach($menu->firstBuckets as $bucket)
                                            <h4 class="sub-menu" data-aos-duration="1000" data-aos="{{ $loop->parent->index % 2 == 0 ? 'fade-right' : 'fade-up' }}">
                                                {{ $bucket['submenu']->title }}
                                            </h4>

                                            @foreach($bucket['items'] as $menuItem)
                                                <li data-aos-duration="1000" data-aos="fade-up">
                                                    <h5 class="name">
                                                        <span class="txt full-title">{{ $menuItem?->title }}</span>
                                                        <span class="txt title-with-price">
                                                        {{ $menuItem?->title }} <br class="break-point">
                                                        ( <span class="p-price">{{ $menuItem?->special_price }}</span> kr )
                                                    </span>
                                                        <span class="price">{{ $menuItem?->special_price }} kr</span>
                                                    </h5>
                                                    <p>{{ $menuItem?->description }}</p>
                                                </li>
                                            @endforeach
                                        @endforeach
                                    </ul>

                                    {{-- FULL-WIDTH (spans both columns under image+first list) --}}
                                    @if($menu->restBuckets->isNotEmpty())
                                        <ul class="menu-list full-width">
                                            @foreach($menu->restBuckets as $bucket)
                                                @if($bucket['show_header'] ?? true)
                                                    <h4 class="sub-menu" data-aos-duration="1000" data-aos="fade-up">
                                                        {{ $bucket['submenu']->title }}
                                                    </h4>
                                                @endif
                                                @foreach($bucket['items'] as $menuItem)
                                                    <li data-aos-duration="1000" data-aos="fade-up">
                                                        <h5 class="name">
                                                            <span class="txt full-title">{{ $menuItem?->title }}</span>
                                                            <span class="txt title-with-price">
                                                          {{ $menuItem?->title }} <br class="break-point">
                                                          ( <span class="p-price">{{ $menuItem?->special_price }}</span> kr )
                                                        </span>
                                                            <span class="price">{{ $menuItem?->special_price }} kr</span>
                                                        </h5>
                                                        <p>{{ $menuItem?->description }}</p>
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    @endif
                                @else
                                    {{-- FIRST BUCKETS (stay beside image) --}}
                                    <ul class="menu-list">
                                        <p class="sub-title" data-aos-duration="1000" data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-up' }}">
                                            {{ $menu?->description }}
                                        </p>
                                        <h4 data-aos-duration="1000" data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-up' }}">
                                            {{ $menu?->title }}
                                        </h4>

                                        @foreach($menu->firstBuckets as $bucket)
                                            <h4 class="sub-menu" data-aos-duration="1000" data-aos="{{ $loop->parent->index % 2 == 0 ? 'fade-right' : 'fade-up' }}">
                                                {{ $bucket['submenu']->title }}
                                            </h4>

                                            @foreach($bucket['items'] as $menuItem)
                                                <li data-aos-duration="1000" data-aos="fade-up">
                                                    <h5 class="name">
                                                        <span class="txt full-title">{{ $menuItem?->title }}</span>
                                                        <span class="txt title-with-price">
                                                        {{ $menuItem?->title }} <br class="break-point">
                                                        ( <span class="p-price">{{ $menuItem?->special_price }}</span> kr )
                                                    </span>
                                                        <span class="price">{{ $menuItem?->special_price }} kr</span>
                                                    </h5>
                                                    <p>{{ $menuItem?->description }}</p>
                                                </li>
                                            @endforeach
                                        @endforeach
                                    </ul>

                                    {{-- IMAGE (left on odd, right on even via .right) --}}
                                    <div class="image" data-aos-duration="1000" data-aos="{{ $loop->index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                                        <img src="{{ $menu?->getFirstMediaUrl('image') }}" alt="">
                                    </div>

                                    {{-- FULL-WIDTH (spans both columns under image+first list) --}}
                                    @if($menu->restBuckets->isNotEmpty())
                                        <ul class="menu-list full-width">
                                            @foreach($menu->restBuckets as $bucket)
                                                @if($bucket['show_header'] ?? true)
                                                    <h4 class="sub-menu" data-aos-duration="1000" data-aos="fade-up">
                                                        {{ $bucket['submenu']->title }}
                                                    </h4>
                                                @endif
                                                @foreach($bucket['items'] as $menuItem)
                                                    <li data-aos-duration="1000" data-aos="fade-up">
                                                        <h5 class="name">
                                                            <span class="txt full-title">{{ $menuItem?->title }}</span>
                                                            <span class="txt title-with-price">
                                                          {{ $menuItem?->title }} <br class="break-point">
                                                          ( <span class="p-price">{{ $menuItem?->special_price }}</span> kr )
                                                        </span>
                                                            <span class="price">{{ $menuItem?->special_price }} kr</span>
                                                        </h5>
                                                        <p>{{ $menuItem?->description }}</p>
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="m-video">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="video-main">
                            <a href="/videos/video2.mp4" class="popup-youtube wrap-video">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
