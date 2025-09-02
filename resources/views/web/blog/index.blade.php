@php use App\Helpers\Constants; @endphp
@extends('web.layout.master')

@section('content')

    <!-- hero area start -->
    <div class="hero-area relative mt-[50px]">
        <!-- breadcroumb area start -->
        <div style="background-image: url('/img/breadcroumb/breadcroumb.jpg')"
             class="tractour-breadcroumb breadcroumb-bg text-center bg-[center_center] bg-cover relative h-[300px] pt-[130px] pb-5 px-0 before:content-[''] before:absolute before:w-full before:h-full before:opacity-80 before:left-0 before:top-0 before:!bg-black">
            <div class="container relative">
                <div class="flex flex-wrap mx-[-12px]">
                    <div class="w-full flex-[0_0_auto] px-[12px] max-w-full">
                        <h2 class=" text-white text-[40px] font-semibold leading-[45px] capitalize mb-20 font-Montserrat sm:mb-[50px]">
                            {{trans('website.pages.blog.heading.title')}}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcroumb area end -->
    </div>
    <!-- hero area end -->
    <!-- blog area start -->
    <div class="blog-area p-[100px_0]">
        <div class="container">
            <div class="flex flex-wrap mx-[-12px] gap-y-3">
                @foreach($blogs as $blog)
                    <div class="lg:w-4/12 w-full max-w-full px-[12px]">
                        <div class="single-blog">
                            <a href="{{$blog->path}}" class="img-date-wrape relative block">
                                <img src="{{$blog->getFirstMediaUrl('image','480')}}" alt="{{$blog->title}}" class="img-fluid w-full rounded-[4px_4px_0_0]"/>
                                <div class="blog-date inline-block text-white text-[14px] font-normal capitalize leading-[14px] absolute p-[15px] left-0 bottom-[30px] bg-[#17469e] font-OpenSans">
                                    {{session('locale',app()->getLocale())==='fa'?jdate($blog->created_at)->format(Constants::DEFAULT_DATE_FORMAT):$blog->created_at->format(Constants::DEFAULT_DATE_FORMAT)}}
                                </div>
                            </a>
                            <div class="blog-content pt-[15px] pb-[30px] px-[15px]">
                                <h3>
                                    <a class="text-[20px] leading-[30px] font-semibold text-[#222222] capitalize font-Montserrat"
                                       href="{{$blog->path}}">
                                        {{\Illuminate\Support\Str::limit($blog->title,70)}}
                                    </a>
                                </h3>
                                <span class=" w-[100px] h-[5px] block mx-0 my-3 bg-[#17469e]"></span>
                                <p class=" text-[15px] text-[#363636]">{{$blog->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="h-[50px]"></div>
            <div class="tractour-pagination" aria-label="page navigation example">
                {{$blogs->links()}}
            </div>
        </div>
    </div>
    <!-- blog area end -->

@endsection