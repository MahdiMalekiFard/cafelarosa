@extends('web.layout.main')

@section('content')
    <div class="">
        <section class="page-title p-portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="page-title-main">
                            <h2 class="title">{{ trans('page.pages.portfolio.detail.page_title') }}</h2>

                            <ul class="breacrumd">
                                <li><a href="/">{{ trans('home.header.home') }} </a></li>
                                <li>/</li>
                                <li><a href="{{ route('portfolio-list', ['locale' => app()->getLocale()]) }}">{{ trans('page.pages.portfolio.list.breadcrumb') }} </a></li>
                                <li>/</li>
                                <li>{{ trans('page.pages.portfolio.detail.breadcrumb') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="portfolio-details">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="portfolio-details-main">
                            <div class="image" data-aos-duration="1000" data-aos="fade-up">
                                <img src="{{ $portfolio->getFirstMediaUrl('image') }}" alt="">
                            </div>

                            <div class="content">
                                <div class="left">
                                    <h4 class="title" data-aos-duration="1000" data-aos="fade-up">{{ $portfolio->title }}</h4>
                                    <p data-aos-duration="1000" data-aos="fade-up">{{ $portfolio->description }}</p>
                                    <div class="">{!! $portfolio->body !!}</div>
                                </div>
                                <div class="right">
                                    <div class="details" data-aos-duration="1000" data-aos="fade-left">
                                        <div class="top">
                                            <h6>{{ trans('page.pages.portfolio.detail.sidebar.text') }}</h6>
                                        </div>
                                        <div class="main">
                                            <ul>
                                                <li>
                                                    <h6>{{ trans('page.pages.portfolio.detail.sidebar.categories') }}:

                                                    </h6>
                                                    <p>{{ implode(', ', $portfolio?->categories->pluck('title')->toArray()) }}</p>
                                                </li>
                                                <li>
                                                    <h6>{{ trans('page.pages.portfolio.detail.sidebar.name') }}:

                                                    </h6>
                                                    <p>{{ $portfolio->title }}</p>
                                                </li>
                                                <li>
                                                    <h6>{{ trans('page.pages.portfolio.detail.sidebar.date') }}: </h6>
                                                    <p>{{ $portfolio->updated_at->format('M j, Y') }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
