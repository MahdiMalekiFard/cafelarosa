<!doctype html>
<html class="no-js" lang="{{session('locale',app()->getLocale())}}" data-theme="light" dir="{{session('locale',app()->getLocale())==='fa'?'rtl':'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Amoot Sazeh|آموت سازه</title>
    <meta name="author" content="sajad eskandarian and sajad khodabakhshi">
    <meta name="developer" content="https://karnoweb.com">
    <meta name="keywords"
          content="قالب HTML5 و CSS3 کسب‌وکار با تیل‌ویند، صنعت، مواد شیمیایی، شرکت، مهندسی، کارخانه، ماشین‌آلات، تولید، نفت و گاز، پتروشیمی، نیرو، پالایشگاه، کوچک‌مقیاس">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/meanmenu.css">
    <link rel="stylesheet" href="/css/nice-select.css">
    <link rel="stylesheet" href="/css/style.css">
    @vite('resources/css/website.css')
</head>

<body>
<!-- header area start -->
<header class="header-area relative">
    <!-- header top area start -->
    <div class="header-top-area !bg-[#222222] text-center p-[0px_0]">
        <div class="container">
            <div class="flex flex-wrap mx-[-12px]">
                <div class="w-full flex justify-between items-center  px-[12px] max-w-full">
                    <div class="tractor-lang mx-0 my-1 sm:block sm:mx-0 sm:my-2.5 w-fit">
                        @if(session('locale','fa')==='fa')
                            <a class="w-[100px] text-white capitalize rounded-none bg-transparent sm:float-none  sm:inline-block " href="{{route('change-locale',['lang'=>'en','locale'=>'en'])}}">انگلیسی</a>
                        @else
                            <a class="w-[100px] text-white capitalize rounded-none bg-transparent sm:float-none  sm:inline-block " href="{{route('change-locale',['lang' => 'fa','locale'=>'fa'])}}">فارسی</a>
                        @endif
                    </div>
                    <ul class="header-top-social lg:!inline-block mx-0 my-2 !hidden">
                        <li class=" inline-block">
                            <a class=" text-white text-xl px-2.5 py-0" href="https://t.me/Amoot_saze">
                                <i class="fa fa-telegram"></i>
                            </a>
                        </li>
                        <li class=" inline-block">
                            <a class=" text-white text-xl px-2.5 py-0" href="https://www.instagram.com/Amoot.maftol">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <div
                            class="quote-btn w-fit sm:clear-both sm:text-center sm:my-0">
                        <a href="{{route('index')}}#contact-us"
                           class=" text-[#222222] text-[15px] font-semibold tracking-[1px] leading-[21px] uppercase px-5 py-2.5 border-0 font-OpenSans inline-block btn-type-4">{{trans('website.header.links.contact_us')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top area end -->
    <!-- header middle area start -->
    <div class="header-middle-area p-[30px_0]">
        <div class="container">
            <div class="flex flex-wrap mx-[-12px]">
                <div class="xl:w-5/12 lg:w-5/12 md:w-5/12 w-full hidden lg:flex justify-start max-w-full px-[12px]">
                    <div class="header-middle-logo inline-block sm:block sm:text-center sm:mx-0">
                        <a href="/">
                            <img src="/img/logo.png" alt="amoot" class="img-fluid sm:m-[0_auto] w-20"/>
                        </a>
                    </div>
                </div>
                <div class="xl:w-7/12 lg:w-7/12 md:w-7/12 w-full flex-[0_0_auto] max-w-full px-[12px]">
                    <ul
                            class="flex justify-center lg:justify-between items-center mx-0 my-[7px] sm:text-center">
                        <li class=" flex items-center justify-center ml-5 relative">
                            <div class="flex items-center w-[30px] h-[30px] bg-[#17469e] me-2.5  justify-center">
                                <i class="fa fa-phone text-white text-center text-lg"></i>
                            </div>
                            <div class="hidden short-info text-[14px] capitalize text-[#777777] font-normal font-OpenSans lg:block">
                                {{trans('website.contact_info.phone')}}: <h4 class=" text-[14px] font-bold leading-[18px]">05137050881</h4>
                            </div>
                            <a href="tel:05137050881" class="absolute inset-0"></a>
                        </li>
                        <li class=" flex items-center justify-center ml-5 relative">
                            <div class="flex items-center w-[30px] h-[30px] bg-[#17469e] me-2.5  justify-center">
                                <i class="fa fa-mobile text-white text-center"></i>
                            </div>
                            <div class="hidden short-info text-[14px] capitalize text-[#777777] font-normal font-OpenSans lg:block">
                                {{trans('website.contact_info.mobile')}}: <h4 class=" text-[14px] font-bold leading-[18px]">09150265615</h4>
                            </div>
                            <a href="tel:09150265615" class="absolute inset-0"></a>
                        </li>
                        <li class=" flex items-center justify-center ml-5">
                            <a href="#contact-text-info" class="flex items-center w-[30px] h-[30px] bg-[#17469e] me-2.5  justify-center">
                                <i
                                        class="fa fa-map-marker text-white text-center"></i>
                            </a>
                            <div class="hidden short-info text-[14px] capitalize text-[#777777] font-normal font-OpenSans lg:block">
                                {{trans('website.contact_info.address1')}}: <h4 class=" text-[14px] font-bold leading-[18px]">{{trans('website.contact_info.address1_value')}}</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- main menu area start -->
    @if(request()->routeIs('index'))
        <div class="main-menu-area absolute z-20 w-full">
            <div class="container">
                <div class="main-menu-border max-[600px]:!p-0">
                    <div class="flex flex-wrap mx-[-12px]">
                        <div class="w-full flex-[0_0_auto] max-w-full  px-[12px]">
                            <div class="main-menu-wraper relative shadow-md !rounded-2xl overflow-hidden bg-white max-[600px]:flex max-[600px]:justify-between max-[600px]:items-center max-[600px]:p-4">
                                <div class="main-menu flex items-center  justify-center">
                                    <nav id="mobile-menu" class="max-[600px]:!hidden" style="display: block;">
                                        <ul class="py-6">
                                            <li class="active cursor-pointer">
                                                <a class="!pt-0 !pb-2 !px-4" data-section="home">{{trans('website.header.links.home')}}</a>
                                            </li>
                                            <li class="cursor-pointer">
                                                <a class="!pt-0 !pb-2 !px-4" data-section="detail">{{trans('website.header.links.detail')}}</a>
                                            </li>
                                            <li class="cursor-pointer">
                                                <a class="!pt-0 !pb-2 !px-4" data-section="project">{{trans('website.header.links.project')}}</a>
                                            </li>
                                            <li class="cursor-pointer">
                                                <a class="!pt-0 !pb-2 !px-4" data-section="about-us">{{trans('website.header.links.about')}}</a>
                                            </li>
                                            <li class="cursor-pointer">
                                                <a class="!pt-0 !pb-2 !px-4" data-section="faq">{{trans('website.header.links.faq')}}</a>
                                            </li>
                                            <li class="cursor-pointer">
                                                <a class="!pt-0 !pb-2 !px-4" data-section="blog">{{trans('website.header.links.blog')}}</a>
                                            </li>
                                            <li class="cursor-pointer">
                                                <a class="!pt-0 !pb-2 !px-4" data-section="contact-us">{{trans('website.header.links.contact_us')}}</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <img src="/img/logo.png" alt="لوگو" class="imgLogoJs w-14 max-[600px]:!block">
                                </div>
                                <!-- ایکون همبرگری برای باز کردن سایدبار -->
                                <button id="hamburgerMenu" class="md:hidden p-3 bg-gray-100 rounded-full text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                    </svg>
                                </button>

                                <!-- سایدبار موبایل -->
                                <div id="mobileSidebar" class="fixed top-0 left-0 w-64 bg-gradient-to-b from-gray-50 to-gray-100 h-full shadow-xl transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
                                    <div class="p-6">
                                        <div class="flex justify-between items-center mb-6">
                                            <h2 class="text-2xl font-bold text-gray-800">{{trans('website.website_name')}}</h2>
                                            <button id="closeSidebar" class="text-gray-600 hover:text-gray-800 text-2xl">×</button>
                                        </div>
                                        <nav id="mobile-menu-sidebar">
                                            <ul class="space-y-4">
                                                <li class="active">
                                                    <a href="#" class="block py-3 px-4 text-gray-700 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200 font-medium" data-section="home">{{trans('website.header.links.home')}}</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block py-3 px-4 text-gray-700 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200 font-medium" data-section="detail">{{trans('website.header.links.detail')}}</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block py-3 px-4 text-gray-700 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200 font-medium" data-section="project">{{trans('website.header.links.project')}}</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block py-3 px-4 text-gray-700 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200 font-medium" data-section="about-us">{{trans('website.header.links.about')}}</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block py-3 px-4 text-gray-700 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200 font-medium" data-section="faq">{{trans('website.header.links.faq')}}</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block py-3 px-4 text-gray-700 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200 font-medium" data-section="blog">{{trans('website.header.links.blog')}}</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block py-3 px-4 text-gray-700 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200 font-medium" data-section="contact-us">{{trans('website.header.links.contact_us')}}</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- main menu area end -->
    <!-- header middle area end -->

    <!-- modal project -->
    <!-- مودال مخفی با بک‌دراپ بلور -->
    <div id="projectModal" class="fixed inset-0  bg-opacity-50 backdrop-blur-md flex items-center justify-center hidden z-50">
        <div class="bg-white p-5 rounded-xl shadow-md max-w-4xl w-[90%] relative transform scale-95 opacity-0 transition-all duration-300">
            <!-- دکمه بستن (X) در گوشه سمت چپ بالا -->
            <button id="closeModal" class="absolute right-4 top-0 text-gray-600 hover:text-gray-800 text-4xl font-bold cursor-pointer">×</button>

            <!-- محتوای مودال: دو بخش (چپ: عنوان + توضیحات، راست: تصویر) -->
            <div class="flex flex-col md:flex-row gap-6 p-4">
                <!-- بخش چپ: عنوان و توضیحات -->
                <div class="md:w-1/2">
                    <h2 id="modalTitle" class="text-2xl font-bold mb-3 text-blue-700"></h2> <!-- خالی نگه داشته شده برای پر شدن داینامیک -->
                    <p id="modalDescription" class="text-gray-600 leading-relaxed"></p> <!-- خالی نگه داشته شده برای پر شدن داینامیک -->
                </div>
                <!-- بخش راست: تصویر -->
                <div class="md:w-1/2">
                    <img id="modalImage" class="w-full h-auto rounded-lg object-cover" alt="تصویر پروژه"/>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal project -->
</header>
<!-- header area end -->

@yield('content')

<div class="footer-copyright px-0 py-[33px] bg-black">
    <div class="container">
        <div class="flex flex-wrap mx-[-12px]">
            <div class="w-full flex justify-between items-center px-[12px] max-w-full flex-col md:flex-row">

                <a href="{{route('index')}}" class="w-14">
                    <img src="/img/Amoot%20PNG-W.png" alt="لوگو" class="w-14">
                </a>

                <div class="copy-right text-center text-[15px] text-white leading-7 capitalize font-OpenSans">
                    {{trans('website.contact_info.address2_value')}}
                </div>

                <ul class="header-top-social mx-0 my-2">
                    <li class=" inline-block">
                        <a class=" text-white text-xl px-2.5 py-0" href="https://t.me/Amoot_saze">
                            <i class="fa fa-telegram"></i>
                        </a>
                    </li>
                    <li class=" inline-block">
                        <a class=" text-white text-xl px-2.5 py-0" href="https://www.instagram.com/Amoot.maftol">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!-- footer area end -->
<!-- whatsapp button -->
<a
    href="https://wa.me/09352616689"
    target="_blank"
    class="block fixed p-2 border-[none] right-[23px] bottom-[23px] bg-white  z-10 w-16 h-16 shadow-lg rounded-lg">
    <svg class="animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 258"><defs><linearGradient id="logosWhatsappIcon0" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#1faf38"/><stop offset="100%" stop-color="#60d669"/></linearGradient><linearGradient id="logosWhatsappIcon1" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#f9f9f9"/><stop offset="100%" stop-color="#fff"/></linearGradient></defs><path fill="url(#logosWhatsappIcon0)" d="M5.463 127.456c-.006 21.677 5.658 42.843 16.428 61.499L4.433 252.697l65.232-17.104a123 123 0 0 0 58.8 14.97h.054c67.815 0 123.018-55.183 123.047-123.01c.013-32.867-12.775-63.773-36.009-87.025c-23.23-23.25-54.125-36.061-87.043-36.076c-67.823 0-123.022 55.18-123.05 123.004"/><path fill="url(#logosWhatsappIcon1)" d="M1.07 127.416c-.007 22.457 5.86 44.38 17.014 63.704L0 257.147l67.571-17.717c18.618 10.151 39.58 15.503 60.91 15.511h.055c70.248 0 127.434-57.168 127.464-127.423c.012-34.048-13.236-66.065-37.3-90.15C194.633 13.286 162.633.014 128.536 0C58.276 0 1.099 57.16 1.071 127.416m40.24 60.376l-2.523-4.005c-10.606-16.864-16.204-36.352-16.196-56.363C22.614 69.029 70.138 21.52 128.576 21.52c28.3.012 54.896 11.044 74.9 31.06c20.003 20.018 31.01 46.628 31.003 74.93c-.026 58.395-47.551 105.91-105.943 105.91h-.042c-19.013-.01-37.66-5.116-53.922-14.765l-3.87-2.295l-40.098 10.513z"/><path fill="#fff" d="M96.678 74.148c-2.386-5.303-4.897-5.41-7.166-5.503c-1.858-.08-3.982-.074-6.104-.074c-2.124 0-5.575.799-8.492 3.984c-2.92 3.188-11.148 10.892-11.148 26.561s11.413 30.813 13.004 32.94c1.593 2.123 22.033 35.307 54.405 48.073c26.904 10.609 32.379 8.499 38.218 7.967c5.84-.53 18.844-7.702 21.497-15.139c2.655-7.436 2.655-13.81 1.859-15.142c-.796-1.327-2.92-2.124-6.105-3.716s-18.844-9.298-21.763-10.361c-2.92-1.062-5.043-1.592-7.167 1.597c-2.124 3.184-8.223 10.356-10.082 12.48c-1.857 2.129-3.716 2.394-6.9.801c-3.187-1.598-13.444-4.957-25.613-15.806c-9.468-8.442-15.86-18.867-17.718-22.056c-1.858-3.184-.199-4.91 1.398-6.497c1.431-1.427 3.186-3.719 4.78-5.578c1.588-1.86 2.118-3.187 3.18-5.311c1.063-2.126.531-3.986-.264-5.579c-.798-1.593-6.987-17.343-9.819-23.64"/></svg>
</a>
<!-- JS here -->
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="/js/jquery-3.7.0.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/meanmenu.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/nice-select.min.js"></script>
<script src="/js/scrolltop.js"></script>
<script src="/js/wow.min.js"></script>
<script src="/js/ajax-form.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
