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
                        <h1 class=" text-white text-[40px] font-semibold leading-[45px] capitalize mb-20 font-Montserrat sm:mb-[50px]">{{$blog->title}}</h1>
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
            <div class="flex flex-wrap mx-[-12px]">
                <div class="md:w-2/3  ">
                    <div class="blog-details">
                        <div class="img-date-wrape relative block">
                            <img src="{{$blog->getFirstMediaUrl('image','720')}}" alt="blog-img" class="img-fluid w-full rounded-[4px_4px_0_0]">
                            <div class="blog-date inline-block text-white text-[14px] font-normal capitalize leading-[14px] absolute p-[15px] left-0 bottom-[30px] bg-[#17469e] font-OpenSans">
                                {{session('locale',app()->getLocale())==='fa'?jdate($blog->created_at)->format(Constants::DEFAULT_DATE_FORMAT):$blog->created_at->format(Constants::DEFAULT_DATE_FORMAT)}}
                            </div>
                        </div>
                        <div class="blog-content pt-[15px] pb-[30px] px-[15px]">
                            <h3><a class="text-[20px] leading-[30px] font-semibold text-[#222222] capitalize font-Montserrat" href="#">{{$blog->title}}</a></h3>
                            <span class=" w-[100px] h-[5px] block mx-0 my-3 bg-[#17469e]"></span>
                            {!! $blog->body !!}
                        </div>
                    </div>
                </div>
                <div class="md:w-1/3  ">
                    <div class="flex flex-wrap mx-[-12px]">
                        <div class="w-full flex-[0_0_auto] px-[12px] max-w-full">

                            <!-- latest post wedget -->
                            <div class="single-sid-wdg mb-[30px] p-[30px] bg-[#fbfbfb]">
                                <h4 class="sid-wdg-title text-[20px] font-normal capitalize mb-5"><strong class=" font-bold text-[#222]">{{trans('website.pages.blog_detail.latest_blog')}}</h4>
                                <div class="sid-wdg-post">
                                    @foreach($latestBlogs as $item)
                                        <div class="single-wdg-post flex mb-5 last:mb-0 group">
                                            <div class="wdg-post-img min-w-[100px] h-auto">
                                                <a href="{{$item->path}}">
                                                    <img src="{{$item->getFirstMediaUrl('image','480')}}" alt="{{$item->title}}" class=" w-[80px]">
                                                </a>
                                            </div>
                                            <div class="wdg-post-content pl-3">

                                                <h5 class=" text-[15px] font-semibold leading-5"><a class=" group-hover:text-[#ffab00]" href="{{$item->path}}">
                                                        {{\Illuminate\Support\Str::limit($item->description,50)}}
                                                    </a></h5>
                                                <span class=" block text-[14px] font-normal text-[#777777] mt-2.5 font-OpenSans">
                                                    {{session('locale',app()->getLocale())==='fa'?jdate($item->created_at)->format(Constants::DEFAULT_DATE_FORMAT):$item->created_at->format(Constants::DEFAULT_DATE_FORMAT)}}
                                                </span>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- archive post wedget -->
                            <div class="single-sid-wdg mb-[30px] p-[30px] bg-[#fbfbfb]">
                                <h4 class="sid-wdg-title text-[20px] font-normal capitalize mb-5"><strong class=" font-bold text-[#222]">{{trans('website.pages.blog_detail.categories')}}</h4>
                                <ul class="wdg-post-archive">
                                    @foreach($blogCategories as $cat)
                                        <li class="mb-[25px] group">
                                            <a class="text-[15px] text-[#757575] font-normal block capitalize font-OpenSans group-hover:text-[#ffab00]" href="{{route('blog.index',['category_id'=>$cat->id])}}">
                                                <i class="fa fa-caret-right me-2.5"></i>
                                                {{$cat->title}}
                                                <span class="float-end">{{$cat->blogs_count}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- follow us wedget -->
                            <div class="single-sid-wdg mb-[30px] p-[30px] bg-[#fbfbfb]">
                                <h4 class="sid-wdg-title text-[20px] font-normal capitalize mb-5"><strong class=" font-bold text-[#222]">{{trans('website.pages.blog_detail.social_networks')}}</h4>
                                <ul class="wdg-follow-us">
                                    <li class="inline-block m-[0_5px]">
                                        <a class=" block text-center text-[20px] text-white leading-10 w-10 h-10 transition-[0.3s] duration-[all] rounded-[50%] hover:text-white bg-black hover:bg-[#ffab00]"
                                           target="_blank"
                                           href="https://t.me/Amoot_saze">
                                            <i class="fa fa-telegram"></i>
                                        </a>
                                    </li>
                                    <li class="inline-block m-[0_5px]">
                                        <a class=" block text-center text-[20px] text-white leading-10 w-10 h-10 transition-[0.3s] duration-[all] rounded-[50%] hover:text-white bg-black hover:bg-[#ffab00]"
                                           target="_blank"
                                           href="https://www.instagram.com/Amoot.maftol">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog area end -->

@endsection