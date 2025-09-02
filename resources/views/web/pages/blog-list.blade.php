@extends('web.layout.main')

@section('content')
    <div class="p-blog">
        <section class="page-title p-blog-full">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-main">
                            <h2 class="title">{{ trans('page.pages.blog.list.page_title') }}</h2>

                            <ul class="breacrumd">
                                <li><a href="/">{{ trans('home.header.home') }} </a></li>
                                <li>/</li>
                                <li>{{ trans('page.pages.blog.list.breadcrumb') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="s-blog blog-list">
            <div class="container">
                <div class="row blog-main">
                    @foreach($blogs as $blog)
                        <div class="col-xl-4 col-md-6">
                            <div class="blog-box" data-aos-duration="1000" data-aos="fade-up">
                                <div class="top-content">
                                    <div class="image">
                                        <img src="{{ $blog?->getFirstMediaUrl('image') }}" alt="">
                                    </div>
                                    <div class="meta">
                                        <h4>{{ $blog?->updated_at->format('y') }}</h4>
                                        <p>{{ $blog?->updated_at->format('M j') }}</p>
                                    </div>
                                    <a href="{{ route('blog-detail', ['locale' => app()->getLocale(), 'blog' => $blog?->slug]) }}" class="h5 title">{{ $blog?->title }}</a>
                                </div>
                                <div class="bottom-content">
                                    <ul>
                                        <li class="author"><a href="#">ved {{ $blog?->user?->name }}</a></li>
                                        <li class="category"><a href="#">{{ implode(', ', $blog?->categories->pluck('title')->toArray()) }}</a></li>
                                    </ul>
                                    <div class="line"></div>
                                    <p class="text">{{ Str::words($blog?->description, 18) }}</p>
                                    <a href="{{ route('blog-detail', ['locale' => app()->getLocale(), 'blog' => $blog?->slug]) }}" class="btn-read">{{ trans('page.pages.blog.list.button') }} <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
