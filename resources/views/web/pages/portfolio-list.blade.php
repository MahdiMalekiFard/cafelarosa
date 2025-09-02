@extends('web.layout.main')

@section('content')
    <div class="p-portfolio">
        <section class="page-title p-portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="page-title-main">
                            <h2 class="title">{{ trans('page.pages.portfolio.list.page_title') }}</h2>

                            <ul class="breacrumd">
                                <li><a href="/">{{ trans('home.header.home') }} </a></li>
                                <li>/</li>
                                <li>{{ trans('page.pages.portfolio.list.breadcrumb') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="portfolio">
            <div class="container">
                <div class="row">
                    @foreach($portfolios as $portfolio)
                        <div class="col-xl-4 col-md-6">
                            <div class="portfolio-box">
                                <div class="image"><img src="{{ $portfolio?->getFirstMediaUrl('image') }}" alt="{{ $portfolio?->title }}"></div>
                                <div class="content">
                                    <h5 class="name">{{ $portfolio?->title }}</h5>
                                    <p class="cate">{{ implode(' - ', $portfolio?->categories->pluck('title')->toArray()) }}</p>
                                    <div class="line"></div>
                                    <p class="text">{{ Str::words($portfolio?->description ?? $portfolio?->body, 12) }}</p>
                                    <a href="{{ route('portfolio-detail', ['locale' => app()->getLocale(), 'portfolio' => $portfolio?->slug]) }}" class="action"><i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
