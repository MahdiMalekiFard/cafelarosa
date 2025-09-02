@extends('web.layout.main')

@section('content')
    <div class="p-about">
        <section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="page-title-main">
                            <h2 class="title">{{ trans('page.pages.about_us') }}</h2>

                            <ul class="breacrumd">
                                <li><a href="/">{{ trans('home.header.home') }} </a></li>
                                <li>/</li>
                                <li>{{ trans('page.pages.about_us') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="chef-restaurant">
            <img class="item-right" src="/img/menu/menu10.png" alt="" data-aos-duration="1000" data-aos="fade-left">
            <img class="item-left" src="/img/menu/menu11.png" alt="" data-aos-duration="1000" data-aos="fade-right">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="menu-content">
                            <div class="block-text center">
                                <p class="subtitle" data-aos-duration="1000" data-aos="fade-up">{{ trans('page.pages.about_restaurant') }}</p>
                                <h3 class="title" data-aos-duration="1000" data-aos="fade-up">{{ $about->title }}</h3>
                                <p class="text" data-aos-duration="1000" data-aos="fade-up">{{ $about->body }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">

            </div>
        </section>

        <secsion class="chef-img">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="list-img">
                            <div class="swiper imagesSwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="/img/about/swiper1.jpg" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/img/about/swiper2.jpg" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/img/about/swiper3.jpg" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="/img/about/swiper4.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </secsion>

        <section class="s-services">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="services-box" data-aos-duration="1000" data-aos="fade-up">
                            <div class="icon">
                                <img src="/img/icon/services-01.png" alt="">
                            </div>
                            <div class="content">
                                <a href="#" class="title h5">{{ trans('page.pages.about.services.service1.title') }}</a>
                                <p>{{ trans('page.pages.about.services.service1.desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="services-box" data-aos-duration="1000" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                            <div class="icon">
                                <img src="/img/icon/services-02.png" alt="">
                            </div>
                            <div class="content">
                                <a href="#" class="title h5">{{ trans('page.pages.about.services.service2.title') }}</a>
                                <p>{{ trans('page.pages.about.services.service2.desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="services-box" data-aos-duration="1000" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <div class="icon">
                                <img src="/img/icon/services-03.png" alt="">
                            </div>
                            <div class="content">
                                <a href="#" class="title h5">{{ trans('page.pages.about.services.service3.title') }}</a>
                                <p>{{ trans('page.pages.about.services.service3.desc') }}</p>
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
                                            <img src="/img/icon/quote.png" alt="">
                                            <h4>{{ $opinion?->subject }}</h4>
                                            <p>{{ $opinion?->comment }}</p>

                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                            </ul>

                                            <h5>{{ $opinion?->user_name }} - {{ $opinion?->company }}</h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="gallery-ig">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="gallery-ig-main">
                            @php
                                $medias = collect($artGalleries)->flatMap(function ($artGallery) {
                                   return $artGallery?->getMedia('gallery') ?? [];
                                });
                                $mediasCount = $medias->count();
                            @endphp

                            @if($mediasCount <= 4)
                                @foreach($medias ?? [] as $media)
                                    <div class="col-img">
                                        <div class="ig-box">
                                            <img src="{{ $media?->getUrl() }}" alt="">
                                        </div>
                                    </div>
                                @endforeach

                            @elseif($mediasCount >= 5)
                                <div class="col-img">
                                    <div class="ig-box">
                                        <img src="{{ $medias[0]->getUrl() }}" alt="">
                                    </div>
                                </div>

                                <div class="col-img">
                                    <div class="top">
                                        <div class="ig-box">
                                            <img src="{{ $medias[1]->getUrl() }}" alt="">
                                        </div>
                                        <div class="ig-box">
                                            <img src="{{ $medias[2]->getUrl() }}" alt="">
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <div class="ig-box">
                                            <img src="{{ $medias[3]->getUrl() }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-img">
                                    <div class="ig-box">
                                        <img src="{{ $medias[4]->getUrl() }}" alt="">
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if($mediasCount)
                            <div class="center mt-50">
                                <a href="{{ route('gallery-list', ['locale' => app()->getLocale()]) }}" class="tf-button style3">view all gallery</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
