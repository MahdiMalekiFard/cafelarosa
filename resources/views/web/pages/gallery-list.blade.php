@extends('web.layout.main')

@section('content')
    <div class="page-gallery p-gallery">
        <section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="page-title-main">
                            <h2 class="title">{{ trans('page.pages.gallery.list.page_title') }}</h2>

                            <ul class="breacrumd">
                                <li><a href="/">{{ trans('home.header.home') }} </a></li>
                                <li>/</li>
                                <li>{{ trans('page.pages.gallery.list.breadcrumb') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="s-gallery">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="gallery-main">
                            @foreach($artGalleries ?? [] as $artGallery)
                                <div class="col-xl-4 col-md-6">
                                    <div class="portfolio-box">
                                        <div class="image" style="margin: 30px"><img src="{{ $artGallery?->getFirstMediaUrl('image') }}" alt="{{ $artGallery?->title }}"></div>
                                        <div class="content" style="min-height: 450px !important;">
                                            <h5 class="name">{{ $artGallery?->title }}</h5>
                                            <div class="line"></div>
                                            <p class="text">{{ Str::words($artGallery?->description) }}</p>
                                            <a href="{{ route('gallery-detail', ['locale' => app()->getLocale(), 'artGallery' => $artGallery?->id]) }}" class="action"><i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="gallery-box">--}}
{{--                                    <img src="{{ $media?->getUrl() }}" alt="">--}}
{{--                                </div>--}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
