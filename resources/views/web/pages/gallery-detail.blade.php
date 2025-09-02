@extends('web.layout.main')

@section('content')
    <div class="page-gallery p-gallery">
        <section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="page-title-main">
                            <h2 class="title">{{ trans('page.pages.gallery.detail.page_title') }}</h2>

                            <ul class="breacrumd">
                                <li><a href="/">{{ trans('home.header.home') }} </a></li>
                                <li>/</li>
                                <li><a href="{{ route('gallery-list', ['locale' => app()->getLocale()]) }}">{{ trans('page.pages.gallery.list.breadcrumb') }} </a></li>
                                <li>/</li>
                                <li>{{ trans('page.pages.gallery.detail.breadcrumb') }}</li>
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
                            @foreach($artGallery?->getMedia('gallery') ?? [] as $media)
                                <div class="gallery-box">
                                    <img src="{{ $media?->getUrl() }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
