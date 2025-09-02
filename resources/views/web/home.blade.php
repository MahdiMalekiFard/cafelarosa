@php @endphp
@extends('web.layout.main')

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.menu-tab li');
            const contents = document.querySelectorAll('.content-tab .content-inner');

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('active'));
                    contents.forEach(c => c.classList.remove('active'));

                    // Add active to clicked tab
                    this.classList.add('active');

                    // Show corresponding content
                    const target = this.getAttribute('data-tab');
                    document.getElementById(target).classList.add('active');
                });
            });
        });
    </script>
@endpush

@section('content')
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
                <div class="swiper-slide">
                    <div class="overlay">
                        <img src="{{ $slider->getFirstMediaUrl('image') }}" alt="slider_img">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-slider">
                                    <div class="content-box">
                                        <h2 class="title">{{ $slider->title }}</h2>
                                        <p class="sub-title">{{ $slider->description }}</p>
                                        <div class="wrap-btn">
                                            <a href="/#menuSection" class="tf-button style2">
                                                {{ trans('slider.discovery_menu') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="contact-info">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 20 20" height="512" viewBox="0 0 20 20" width="512">
                                                <g>
                                                    <path d="m10.1 0c-5.8 0-10.1 2.3-10.1 5v.7c0 .7.6 1.2 1.3 1.3h2.6c.9 0 1.4-1.1 1.1-2-.5-.7 0-1.7.8-1.9 2.8-.6 5.6-.6 8.5 0 .9.2 1.3 1.1.8 1.9-.3.9.2 1.9 1.1 2h2.6c.7 0 1.3-.6 1.3-1.3v-.7c-.1-2.8-4.5-5-10-5z"/>
                                                    <g>
                                                        <path
                                                            d="m15.3 7.5c-.2-.3-.5-.5-.9-.5h-1.4v-1.5c0-.3-.2-.5-.5-.5h-1c-.3 0-.5.2-.5.5v1.5h-2v-1.5c0-.3-.2-.5-.5-.5h-1c-.3 0-.5.2-.5.5v1.5h-1.4c-.4 0-.7.2-.9.5-1.5 2.6-3.7 5.9-3.7 11.5 0 .5.4 1 1 1h16c.6 0 1-.5 1-1 0-5.6-2.3-9.1-3.7-11.5zm-5.3 10.5c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"/>
                                                        <circle cx="10" cy="14" r="2"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="left">
                                            <h6>{{ trans('slider.phone_text') }}</h6>
                                            <h4>+(45) 91 71 97 67</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination pagination-swiper1"></div>
    </div>

    <section class="about">
{{--        <div class="shape"></div>--}}
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-12">
                    <div class="about-img" data-aos-duration="1000" data-aos="fade-right">
                        <img src="{{ $about_page?->getFirstMediaUrl('image') }}" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="about-content">
                        <div class="block-text">
                            <p class="subtitle " data-aos-duration="1000" data-aos="fade-up">{{ trans('home.about_us.text') }}</p>
                            <h3 class="title" data-aos-duration="1000" data-aos="fade-up">{{ $about_page?->title }}</h3>
                            <p class="text" data-aos-duration="1000" data-aos="fade-up">{!! nl2br(e(\Illuminate\Support\Str::words($about_page->body, 80))) !!}</p>

                            <a href="{{ route('about-us', ['locale' => app()->getLocale()]) }}" class="tf-button style3">{{ trans('home.about_us.button') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="opening">
{{--        <div class="shape"></div>--}}
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-md-12">
                    <div class="opening-content">
                        <div class="block-text">
                            <h3 class="title" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.opening_time_hours') }}</h3>
                            <ul>
                                <li data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.sidebar.opening_hours.Monday') }} - {{ trans('home.sidebar.opening_hours.Thursday') }}:</span> 11:30 - 21:00</li>
                                <li data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.sidebar.opening_hours.Friday') }}, {{ trans('home.sidebar.opening_hours.Saturday') }}:</span> 11:30 - 22:00</li>
                                <li data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.sidebar.opening_hours.Sunday') }}:</span> 16:00 - 21:00</li>
                            </ul>

                            <div class="d-flex">
                                <ul>
                                    <h5 data-aos-duration="1000" data-aos="fade-up">{{ trans('home.dining_options') }}</h5>
                                    <li data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.breakfast') }} - {{ trans('home.brunch') }} - {{ trans('home.lunch') }} - {{ trans('home.dinner') }}</span></li>
                                    <li data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.catering') }} - {{ trans('home.counter_service') }} - {{ trans('home.dessert') }} - {{ trans('home.seating') }}</span></li>
                                </ul>
                            </div>

                            <div class="d-flex">
                                <ul>
                                    <h5 data-aos-duration="1000" data-aos="fade-up">{{ trans('home.offerings') }}</h5>
                                    <li data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.alcohol') }} - {{ trans('home.cocktails') }} - {{ trans('home.food') }} - {{ trans('home.organic_dishes') }}</span></li>
                                    <li data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.vegetarian_options') }} - {{ trans('home.beer') }} - {{ trans('home.coffee') }} - {{ trans('home.hard_liquor') }}</span></li>
                                    <li data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.small_plates') }} - {{ trans('home.wine') }} - {{ trans('home.italian_origin_food') }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-md-12">
                    <div class="opening-img" data-aos-duration="1000" data-aos="fade-left">
                        <img src="/img/opening/opening.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="s-menu" id="menuSection">
        <div class="shape" data-aos-duration="1000" data-aos="fade-right">
            <img src="/img/menu/shape-menu.png" alt="">
        </div>
        <div class="container container-min-height">
            <div class="row">
                <div class="menu-content">
                    <div class="block-text center style-2">
                        <p class="subtitle" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.menu.text') }}</p>
                        <h3 class="title" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.menu.title') }}</h3>
                        <p class="text" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.menu.subtitle') }}</p>
                    </div>
                    <div class="flat-tabs" data-aos-duration="1000" data-aos="fade-up">
                        <ul class="menu-tab">
                            @foreach($menus as $index => $menu)
                                <li class="{{ $index === 0 ? 'active' : '' }}" data-tab="tab-{{ $index }}">
                                    <h5>{{ $menu->title }}</h5>
                                </li>
                            @endforeach
                        </ul>

                        <div class="content-tab">
                            @foreach($menus as $index => $menu)
                                <div class="content-inner {{ $index === 0 ? 'active' : '' }}" id="tab-{{ $index }}">
                                    <div class="container_inner">
                                        @php
                                            /** @var \App\Models\Menu $menu */
                                            $items = $menu?->items()->where('published', \App\Enums\BooleanEnum::ENABLE)->limit(6)->get();
                                        @endphp
                                        <div class="left-img">
                                            <img src="{{ $menu->getFirstMediaUrl('left_image') }}" alt="menu_left_img">
                                        </div>
                                        <div class="right-img">
                                            <img src="{{ $menu->getFirstMediaUrl('right_image') }}" alt="menu_right_img">
                                        </div>
                                        <ul class="menu-list">
                                            @foreach($items as $menuItem)
                                                <li>
                                                    <h5 class="name">
                                                        <span class="txt full-title">{{ $menuItem->title }}</span>
                                                        <span class="title-with-price">
                                                            {{ $menuItem?->title }}  ( <span class="p-price">{{ $menuItem?->special_price }}</span> kr )
                                                        </span>
                                                        <span class="price">{{ $menuItem->special_price }} kr</span>
                                                    </h5>
                                                    <p>{{ $menuItem->description }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('menu-list', ['locale' => app()->getLocale()]) }}" class="tf-button style1 mt-39">{{ trans('home.menu.button') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="s-video">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="video-main">
                        <a href="/videos/video1.mp4" class="popup-youtube wrap-video">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="choose">
{{--        <div class="shape"></div>--}}
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-12">
                    <div class="choose-content">
                        <div class="block-text">
                            <p class="subtitle" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.choose_us.text') }}</p>
                            <h3 class="title" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.choose_us.title') }} </h3>

                            <div class="flat-tabs" data-aos-duration="1000" data-aos="fade-up">
                                <ul class="menu-tab">
                                    <li class="active">
                                        <h5>{{ trans('home.ACCESSIBILITY_INCLUSIVITY') }}</h5>
                                    </li>
                                    <li>
                                        <h5>{{ trans('home.QUALITY_SERVICE_CONVENIENCE') }}</h5>
                                    </li>
                                    <li>
                                        <h5>{{ trans('home.FOOD_DRINK_EXPERIENCE') }}</h5>
                                    </li>

                                </ul>

                                <div class="content-tab">
                                    <div class="content-inner">
                                        <div class="container_inner">
                                            <p>{{ trans('home.choose_us.description-1') }}</p>
                                            <ul class="list">
                                                <li>{{ trans('home.choose_us.list1.one') }}</li>
                                                <li>{{ trans('home.choose_us.list1.two') }}</li>
                                                <li>{{ trans('home.choose_us.list1.three') }}</li>
                                                <li>{{ trans('home.choose_us.list1.four') }}</li>
                                            </ul>
                                            <a href="{{ route('about-us', ['locale' => app()->getLocale()]) }}" class="tf-button style3">{{ trans('home.choose_us.button') }}</a>
                                        </div>
                                    </div>
                                    <div class="content-inner">
                                        <div class="container_inner">
                                            <p>{{ trans('home.choose_us.description-2') }}</p>
                                            <ul class="list">
                                                <li>{{ trans('home.choose_us.list2.one') }}</li>
                                                <li>{{ trans('home.choose_us.list2.two') }}</li>
                                                <li>{{ trans('home.choose_us.list2.three') }}</li>
                                                <li>{{ trans('home.choose_us.list2.four') }}</li>
                                            </ul>
                                            <a href="{{ route('about-us', ['locale' => app()->getLocale()]) }}" class="tf-button style3">{{ trans('home.choose_us.button') }}</a>
                                        </div>
                                    </div>
                                    <div class="content-inner">
                                        <div class="container_inner">
                                            <p>{{ trans('home.choose_us.description-3') }}</p>
                                            <ul class="list">
                                                <li>{{ trans('home.choose_us.list3.one') }}</li>
                                                <li>{{ trans('home.choose_us.list3.two') }}</li>
                                                <li>{{ trans('home.choose_us.list3.three') }}</li>
                                            </ul>
                                            <a href="{{ route('about-us', ['locale' => app()->getLocale()]) }}" class="tf-button style3">{{ trans('home.choose_us.button') }}</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="choose-image" data-aos-duration="1000" data-aos="fade-left">
                        <div class="swiper swiperchoose">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="/img/choose/choose-2.jpg" alt=""></div>
                                <div class="swiper-slide"><img src="/img/choose/choose-3.jpg" alt="">
                                </div>
                            </div>
                            <div class="swiper-button-next">{{ trans('home.choose_us.next') }} <br/> {{ trans('home.choose_us.image') }}</div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="swiper testimonialSwiper">
                        <div class="swiper-wrapper">
                            @foreach($opinions as $opinion)
                                <div class="swiper-slide">
                                    <div class="testimonials-content">
                                        <img src="/img/icon/quote.png" alt="" data-aos-duration="1000" data-aos="fade-up">
                                        <h4 data-aos-duration="1000" data-aos="fade-up">{{ $opinion?->subject }}</h4>
                                        <p data-aos-duration="1000" data-aos="fade-up">{{ $opinion?->comment }}</p>
                                        <ul class="rating" data-aos-duration="1000" data-aos="fade-up">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>

                                        <h5 data-aos-duration="1000" data-aos="fade-up">{{ $opinion?->user_name }} - {{ $opinion?->company }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="s-blog">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="block-text center">
                        <p class="subtitle" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.blog.text') }}</p>
                        <h3 class="title" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.blog.title') }}</h3>
                        <p class="text" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.blog.subtitle') }}</p>
                    </div>

                    <div class="swiper blogSwiper">
                        <div class="swiper-wrapper">
                            @foreach($blogs as $blog)
                                <div class="swiper-slide">
                                    <div class="blog-box">
                                        <div class="top-content">
                                            <div class="image">
                                                <img src="{{ $blog?->getFirstMediaUrl('image') ?? '#' }}" alt="">
                                            </div>
                                            <div class="meta">
                                                <h4>{{ $blog?->updated_at->format('y') }}</h4>
                                                <p>{{ $blog?->updated_at->format('M d') }}</p>
                                            </div>
                                            <a href="{{ route('blog-detail', ['locale' => app()->getLocale(), 'blog' => $blog?->slug]) }}" class="h5 title">{{ $blog?->title }}</a>
                                        </div>
                                        <div class="bottom-content">
                                            <ul>
                                                <li class="author"><a href="#">by {{ $blog?->user?->name }}</a></li>
                                                <li class="category"><a href="#">{{ implode(', ', $blog?->categories->pluck('title')->toArray()) }}</a></li>
                                            </ul>
                                            <div class="line"></div>
                                            <p class="text">{{ Str::words($blog?->description, 16) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="block-text center">
                        <a href="{{ route('blog-list', ['locale' => app()->getLocale()]) }}" class="tf-button style3">{{ trans('home.blog.button') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery">
        <div class="container-fluid">
            <div class="row">
                <div class="gallery-main">
                    @foreach($portfolios as $portfolio)
                        <div class="gallery-box">
                            <div class="image"><img src="{{ $portfolio?->getFirstMediaUrl('image') }}" alt=""></div>
                            <div class="content">
                                <h5 class="name">{{ $portfolio?->title }}</h5>
                                <p class="cate">{{ implode(' - ', $portfolio?->categories->pluck('title')->toArray()) }}</p>
                                <div class="line"></div>
                                <p class="text">{{ Str::words($portfolio?->description ?? $portfolio?->body, 14) }}</p>
                                <a href="{{ route('portfolio-detail', ['locale' => app()->getLocale(), 'portfolio' => $portfolio?->slug]) }}" class="action"><i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="location">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-12">
                    <div class="image left" data-aos-duration="1000" data-aos="fade-right"><img src="/img/map/map1.jpg" alt=""></div>
                </div>
                <div class="col-xl-4 col-md-12">
                    <div class="content">
                        <div class="block-text center">
                            <p class="subtitle" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.location.text') }}</p>
                            <h3 class="title" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.location.title') }} </h3>
                            <p class="text" data-aos-duration="1000" data-aos="fade-up">{{ trans('home.location.subtitle1') }}</p>
                            <h6 data-aos-duration="1000" data-aos="fade-up">{{ trans('home.location.subtitle2') }}:</h6>
                            <h3 class="phone" data-aos-duration="1000" data-aos="fade-up">+(45) 91 71 97 67</h3>
                            <h6 data-aos-duration="1000" data-aos="fade-up">{{ trans('home.location.subtitle3') }}:</h6>
                            <p class="mb-6" data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.location.address') }}:</span> Klostergade 19, 6000 Kolding, Denmark</p>
                            <p class="mb-6" data-aos-duration="1000" data-aos="fade-up"><span>{{ trans('home.location.mail') }}:</span> Info@cafelarosa.dk</p>
                            <a href="{{ route('contact-us-page', ['locale' => app()->getLocale()]) }}" class="tf-button style3">{{ trans('home.location.button') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12" data-aos-duration="1000" data-aos="fade-left">
                    <div class="image right">
                        <img src="/img/map/map.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
