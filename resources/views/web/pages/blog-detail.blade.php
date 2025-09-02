@extends('web.layout.main')

@section('content')
    <div class="p-blog-d">
        <section class="page-title p-blog-full">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-main">
                            <h2 class="title">{{ trans('page.pages.blog.detail.page_title') }}</h2>

                            <ul class="breacrumd">
                                <li><a href="/">{{ trans('home.header.home') }} </a></li>
                                <li>/</li>
                                <li><a href="{{ route('blog-list', ['locale' => app()->getLocale()]) }}">{{ trans('page.pages.blog.list.breadcrumb') }} </a></li>
                                <li>/</li>
                                <li>{{ trans('page.pages.blog.detail.breadcrumb') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="blog-sidebar blog-single">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="blog-sidebar-main">
                            <div class="main-content">
                                <div class="blog-box-2">
                                    <a href="#" class="image">
                                        <img src="{{ $blog->getFirstMediaUrl('image') }}" alt="">
                                    </a>
                                    <div class="meta">
                                        <ul>
                                            <li><a href="#">Skrevet af <span>{{ $blog->user->name }}</span> </a></li>
                                            <li><a href="#">{{ $blog->updated_at->format('M j, Y') }}</a></li>
                                            <li><a href="#">{{ implode(', ', $blog?->categories->pluck('title')->toArray()) }}</a></li>
                                        </ul>
                                    </div>

                                    <div class="content">
                                        <a href="#" class="h4 title">{{ $blog->title }}</a>
                                        <p class="text">{{ $blog->description }}</p>
                                        <div class="line"></div>
                                        <div class="">
                                            {!! $blog->body !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-sidebar">
                                <div class="widget latest">
                                    @php
                                        $latestPosts = \App\Models\Blog::query()
                                                ->where('published', \App\Enums\BooleanEnum::ENABLE)
                                                ->whereNot('id', $blog->id)
                                                ->orderByDesc('id')->limit(3)->get();
                                    @endphp
                                    <div class="heading-top">
                                        <h5>{{ trans('page.pages.blog.detail.sidebar.text') }}</h5>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            @foreach($latestPosts ?? [] as $post)
                                                <li>
                                                    <div class="img">
                                                        <img src="{{ $post?->getFirstMediaUrl('image', 'thumb') }}" alt="">
                                                    </div>
                                                    <div class="info">
                                                        <a href="{{ route('blog-detail', ['locale' => app()->getLocale(), 'blog' => $post?->slug]) }}" class="title">
                                                            {{ $post?->title }}
                                                        </a>
                                                        {{--                                                        <p class="meta">Adam John - June 6, 2022</p>--}}
                                                        <p class="text">{{ $post?->user?->name }} - {{ $post?->updated_at->format('M j, Y') }}</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
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
