<!doctype html>
<html class="no-js" lang="{{session('locale',app()->getLocale())}}" dir="{{session('locale',app()->getLocale())==='fa'?'rtl':'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <title>Café La Rosa Kolding</title>
    <meta name="author" content="mahdi malekifard">
    <meta name="developer" content="https://karnoweb.com">
    <meta name="keywords"
          content="café near me, best café, cozy café, café with Wi-Fi, late-night café, pet-friendly café, coffee shop, café menu, tea café, espresso café, latte art café">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/aos.css">
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="/img/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/img/favicon.png">
    <script src="/js/highcharts.js"></script>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body class="main header-fixed home1">

<!-- preload start -->
<div class="preloader">
    <div class="clear-loading loading-effect-2">
        <span></span>
    </div>
</div>
<!-- preload end -->

<div id="wrapper">
    <!-- Top bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-md-12">
                    <div class="list-info">
                        <ul>
                            <li><i class="fa fa-envelope-open"></i> Info@cafelarosa.dk</li>
                            <li><i class="fa fa-map"></i> Klostergade 19, 6000 Kolding, Denmark </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Top bar -->

    <!-- Header -->
    <header id="header_main" class="header style-1">
        <div class="container">
            <div id="site-header-inner">
                <div class="header__logo">
                    <a href="/"><img src="/img/logo2.png" alt="cafelarosa logo"></a>
                </div>
                <nav id="main-nav" class="main-nav">
                    <ul id="menu-primary-menu" class="menu">
                        <li class="menu-item menu-item-has-children {{ request()->routeIs('index') ? 'current-menu-item' : ''}}">
                            <a href="/">{{ trans('home.header.home') }}</a>
                        </li>

                        <li class="menu-item menu-item-has-children {{ request()->routeIs('menu-list') ? 'current-menu-item' : ''}}">
                            <a href="{{ route('menu-list', ['locale' => app()->getLocale()]) }}">{{ trans('home.header.menu') }}</a>
                        </li>

                        <li class="menu-item menu-item-has-children {{ request()->routeIs('portfolio-list') ? 'current-menu-item' : ''}}">
                            <a href="{{ route('portfolio-list', ['locale' => app()->getLocale()]) }}">{{ trans('home.header.portfolio') }}</a>
                        </li>

                        <li class="menu-item menu-item-has-children {{ request()->routeIs('blog-list') ? 'current-menu-item' : ''}}">
                            <a href="{{ route('blog-list', ['locale' => app()->getLocale()]) }}">{{ trans('home.header.blog') }}</a>
                        </li>
                        <li class="menu-item menu-item-has-children {{ request()->routeIs('gallery-list') ? 'current-menu-item' : ''}}">
                            <a href="{{ route('gallery-list', ['locale' => app()->getLocale()]) }}">{{ trans('home.header.gallery') }}</a>
                        </li>
                        <li class="menu-item menu-item-has-children {{ request()->routeIs('about-us') ? 'current-menu-item' : ''}}">
                            <a href="{{ route('about-us', ['locale' => app()->getLocale()]) }}">{{ trans('home.header.about_us') }}</a>
                        </li>
                    </ul>
                </nav><!-- /#main-nav -->

                <a href="{{ route('contact-us-page', ['locale' => app()->getLocale()]) }}" class="tf-button style1 ">{{ trans('home.header.contact_us') }}</a>

                <div class="sidebar-btn">
                    <a class="btn-side">
                        <span></span>
                    </a>
                    <div class="sidebar-content">
                        <img class="sidebar__logo" src="/img/logo2.png" alt="">
                        <p>
                            {{ trans('home.sidebar.description') }}
                        </p>
                        <h4>+(45) 91 71 97 67</h4>
                        <p>Café La Rosa, Klostergade 19, 6000 Kolding, Denmark</p>
                        <p>Info@cafelarosa.dk</p>
                        <div class="line"></div>
                        <p>{{ trans('home.sidebar.opening_hours.text') }} <br />
                            {{ trans('home.sidebar.opening_hours.Monday') }} - {{ trans('home.sidebar.opening_hours.Thursday') }} : 11:30 – 21:00,<br />
                            {{ trans('home.sidebar.opening_hours.Friday') }} , {{ trans('home.sidebar.opening_hours.Saturday') }} : 11:30 – 22:00,<br />
                            {{ trans('home.sidebar.opening_hours.Sunday') }} : 16:00 – 21:00,<br />
                        </p>
                        <div class="line"></div>
                        <ul class="list-social">
                            <li><a href="https://www.facebook.com/share/16e4QpJg17/?mibextid=wwXIfr"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/cafelarosa.kolding?igsh=MWowbzVjM2V5Z2Fu&utm_source=qr"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="https://www.tiktok.com/@cafelarosa"><i class="fa-brands fa-tiktok"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="mobile-button"><span></span></div><!-- /.mobile-button -->
            </div>
        </div>
    </header>
    <!-- end Header -->

    @yield('content')

    <!-- footer start -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget logo">
                        <div class="foo-header">
                            <img class="footer__logo" src="/img/logo2.png" alt="">
                        </div>
                        <p>{{ trans('home.footer.description') }}</p>
                        <ul class="list-social">
                            <li><a href="https://www.facebook.com/share/16e4QpJg17/?mibextid=wwXIfr"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/cafelarosa.kolding?igsh=MWowbzVjM2V5Z2Fu&utm_source=qr"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="https://www.tiktok.com/@cafelarosa"><i class="fa-brands fa-tiktok"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="widget time">
                        <div class="foo-header">
                            <h5>{{ trans('home.footer.opening_time') }}</h5>
                        </div>
                        <ul>
                            <li>{{ trans('home.sidebar.opening_hours.Monday') }} - {{ trans('home.sidebar.opening_hours.Thursday') }}: 11:30 - 21:00</li>
                            <li>{{ trans('home.sidebar.opening_hours.Friday') }}: 11:30 - 22:00</li>
                            <li>{{ trans('home.sidebar.opening_hours.Saturday') }}: 11:30 - 22:00</li>
                            <li>{{ trans('home.sidebar.opening_hours.Sunday') }}: 16:00 - 21:00</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="widget locations">
                        <div class="foo-header">
                            <h5>{{ trans('home.footer.Location') }}</h5>
                        </div>
                        <ul>
                            <li>
                                    <span>{{ trans('home.footer.Address') }}:
                                    </span>
                                <p>Klostergade 19, 6000 Kolding, Denmark</p>
                            </li>
                            <li>
                                    <span>{{ trans('home.footer.Booking_Contact') }}:
                                    </span>
                                <p>Info@cafelarosa.dk
                                </p>
                                <p>+(45) 91 71 97 67</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bottom-footer">
                <div class="bottom-main">
                    <p>{{ trans('home.copy_right') }}</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
</div>

<a id="scroll-top"></a>

<!-- whatsapp button -->
{{--<a--}}
{{--    href="https://wa.me/09352616689"--}}
{{--    target="_blank"--}}
{{--    class="block fixed p-2 border-[none] right-[23px] bottom-[23px] bg-white  z-10 w-16 h-16 shadow-lg rounded-lg">--}}
{{--    <svg class="animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 258"><defs><linearGradient id="logosWhatsappIcon0" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#1faf38"/><stop offset="100%" stop-color="#60d669"/></linearGradient><linearGradient id="logosWhatsappIcon1" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#f9f9f9"/><stop offset="100%" stop-color="#fff"/></linearGradient></defs><path fill="url(#logosWhatsappIcon0)" d="M5.463 127.456c-.006 21.677 5.658 42.843 16.428 61.499L4.433 252.697l65.232-17.104a123 123 0 0 0 58.8 14.97h.054c67.815 0 123.018-55.183 123.047-123.01c.013-32.867-12.775-63.773-36.009-87.025c-23.23-23.25-54.125-36.061-87.043-36.076c-67.823 0-123.022 55.18-123.05 123.004"/><path fill="url(#logosWhatsappIcon1)" d="M1.07 127.416c-.007 22.457 5.86 44.38 17.014 63.704L0 257.147l67.571-17.717c18.618 10.151 39.58 15.503 60.91 15.511h.055c70.248 0 127.434-57.168 127.464-127.423c.012-34.048-13.236-66.065-37.3-90.15C194.633 13.286 162.633.014 128.536 0C58.276 0 1.099 57.16 1.071 127.416m40.24 60.376l-2.523-4.005c-10.606-16.864-16.204-36.352-16.196-56.363C22.614 69.029 70.138 21.52 128.576 21.52c28.3.012 54.896 11.044 74.9 31.06c20.003 20.018 31.01 46.628 31.003 74.93c-.026 58.395-47.551 105.91-105.943 105.91h-.042c-19.013-.01-37.66-5.116-53.922-14.765l-3.87-2.295l-40.098 10.513z"/><path fill="#fff" d="M96.678 74.148c-2.386-5.303-4.897-5.41-7.166-5.503c-1.858-.08-3.982-.074-6.104-.074c-2.124 0-5.575.799-8.492 3.984c-2.92 3.188-11.148 10.892-11.148 26.561s11.413 30.813 13.004 32.94c1.593 2.123 22.033 35.307 54.405 48.073c26.904 10.609 32.379 8.499 38.218 7.967c5.84-.53 18.844-7.702 21.497-15.139c2.655-7.436 2.655-13.81 1.859-15.142c-.796-1.327-2.92-2.124-6.105-3.716s-18.844-9.298-21.763-10.361c-2.92-1.062-5.043-1.592-7.167 1.597c-2.124 3.184-8.223 10.356-10.082 12.48c-1.857 2.129-3.716 2.394-6.9.801c-3.187-1.598-13.444-4.957-25.613-15.806c-9.468-8.442-15.86-18.867-17.718-22.056c-1.858-3.184-.199-4.91 1.398-6.497c1.431-1.427 3.186-3.719 4.78-5.578c1.588-1.86 2.118-3.187 3.18-5.311c1.063-2.126.531-3.986-.264-5.579c-.798-1.593-6.987-17.343-9.819-23.64"/></svg>--}}
{{--</a>--}}

<!-- JS here -->
<script src="/js/jquery-3.7.0.min.js"></script>
<script src="/js/swiper-bundle.min.js"></script>
<script src="/js/swiper.js"></script>
<script src="/js/app.js"></script>
<script src="/js/jquery.easing.js"></script>
<script src="/js/aos.js"></script>
<script src="/js/parallax.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

<script src="/js/count-down.js"></script>
<script src="/js/countto.js"></script>
@stack('js')

</body>
</html>
