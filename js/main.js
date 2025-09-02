 (function ($) {
     "use strict";
     /* ---------------------------------------------- /*
     * Preloader
    /* ---------------------------------------------- */
     $(window).ready(function () {
         $('.tractour-loader').fadeOut();
         $('#spinner').delay(200).fadeOut('slow');

     });





     $(document).ready(function() {
         let isScrolling = false;

         // تابع برای چک کردن موقعیت سکشن‌ها (برای استفاده در لود و اسکرول)
         function checkActiveSection() {
             var sections = ['home', 'detail', 'project', 'about-us', 'faq', 'blog', 'contact-us'];
             var scrollPosition = $(window).scrollTop() + ($(window).height() / 2); // مرکز پنجره

             sections.forEach(function(sectionId) {
                 var section = $('#' + sectionId);
                 if (section.length) {
                     var sectionTop = section.offset().top;
                     var sectionBottom = sectionTop + section.outerHeight();

                     if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                         // حذف کلاس active از همه آیتم‌ها
                         $('#mobile-menu li, #mobile-menu-sidebar li').removeClass('active border-b-2 border-blue-500');

                         // پیدا کردن آیتم با استفاده از data-section روی <a>
                         var $matchingLi = $('#mobile-menu li, #mobile-menu-sidebar li').filter(function() {
                             var linkSection = $(this).find('a').data('section');
                             return linkSection === sectionId;
                         });
                         $matchingLi.addClass('active border-b-2 border-blue-500');
                     }
                 }
             });
         }

         // اجرا موقع لود صفحه
         checkActiveSection();

         // باز و بسته کردن سایدبار با کلیک روی همبرگری
         $('#hamburgerMenu').click(function() {
             $('#mobileSidebar').toggleClass('translate-x-0 -translate-x-full');
             // جلوگیری از اسکرول صفحه هنگام باز شدن سایدبار
             $('body').toggleClass('overflow-hidden', $('#mobileSidebar').hasClass('translate-x-0'));
         });

         // بستن سایدبار با کلیک روی بک‌دراپ (خارج از سایدبار)
         $(document).click(function(e) {
             if (!$(e.target).closest('#mobileSidebar, #hamburgerMenu').length) {
                 $('#mobileSidebar').addClass('-translate-x-full').removeClass('translate-x-0');
                 $('body').removeClass('overflow-hidden'); // بازگرداندن اسکرول صفحه
             }
         });

        $('#closeSidebar').click(function() {
            $('#mobileSidebar').addClass('-translate-x-full').removeClass('translate-x-0');
            $('body').removeClass('overflow-hidden'); // بازگرداندن اسکرول صفحه
        });

         // روی هر لینک داخل nav#mobile-menu و سایدبار کلیک کن (فقط برای اسکرول، بدون اکتیو کردن)
         $('#mobile-menu a, #mobile-menu-sidebar a').click(function(e) {
             e.preventDefault();

             var targetSection = $(this).data('section'); // استفاده مستقیم از data-section روی المنت <a>
             if (targetSection) {
                 $('html, body').animate({
                     scrollTop: $('#' + targetSection).offset().top - 100 // جبران هدر یا نوار ثابت
                 }, 1000);

                 // بستن سایدبار بعد از کلیک روی لینک
                 $('#mobileSidebar').addClass('-translate-x-full').removeClass('translate-x-0');
                 $('body').removeClass('overflow-hidden'); // بازگرداندن اسکرول صفحه
             } else {
                 console.warn('data-section یافت نشد برای لینک:', $(this).text());
             }
         });

         // چک کردن موقعیت اسکرول برای اضافه کردن کلاس active
         $(window).scroll(function() {
             if (!isScrolling) {
                 isScrolling = true;
                 setTimeout(function() {
                     checkActiveSection();
                     isScrolling = false;
                 }, 100); // تاخیر 100 میلی‌ثانیه برای بهینه‌سازی
             }
         });

         // بهینه‌سازی برای موبایل: جلوگیری از جابجایی ناخواسته صفحه
         $(window).resize(function() {
             if ($(window).width() > 600) {
                 $('#mobileSidebar').addClass('-translate-x-full').removeClass('translate-x-0');
                 $('body').removeClass('overflow-hidden');
             }
         });
     });

     $(document).ready(function() {
         // وقتی روی دکمه "more" (با کلاس btn-type-5) کلیک می‌کنی
         $('.btn-type-5').click(function(e) {
             e.preventDefault();

             // پیدا کردن المنت‌های مرتبط (عنوان پروژه و تصویر)
             var $project = $(this).closest('.single-project');
             var imageSrc = $project.find('img').attr('src'); // مسیر تصویر پروژه
             var title = $project.data('title'); // گرفتن عنوان از data-title
             var description = $project.data('description'); // گرفتن توضیحات از data-description

             // پر کردن محتوای مودال
             $('#modalImage').attr('src', imageSrc);
             $('#modalTitle').text(title); // تنظیم عنوان در مودال
             $('#modalDescription').html(description); // تنظیم توضیحات در مودال

             // نمایش مودال با انیمیشن
             var $modal = $('#projectModal');
             var $modalContent = $modal.find('.bg-white');

             $modal.removeClass('hidden');
             setTimeout(() => {
                 $modalContent.removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
             }, 10); // تاخیر کوچک برای شروع انیمیشن
         });

         // بستن مودال با کلیک روی X
         $('#closeModal').click(function() {
             var $modalContent = $('#projectModal .bg-white');
             $modalContent.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
             setTimeout(() => {
                 $('#projectModal').addClass('hidden');
             }, 300); // تاخیر برابر با duration انیمیشن
         });

         // بستن مودال با کلیک روی بک‌دراپ (پس‌زمینه با بلور)
         $('#projectModal').click(function(e) {
             if (e.target === this) {
                 var $modalContent = $(this).find('.bg-white');
                 $modalContent.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
                 setTimeout(() => {
                     $(this).addClass('hidden');
                 }, 300); // تاخیر برابر با duration انیمیشن
             }
         });
     });

     $(document).ready(function() {
         var menu = $('.main-menu-area');
         var scrollPosition = $(window).scrollTop(); // موقعیت اسکرول کاربر
         if (scrollPosition > 100) {
             menu.addClass('fixed top-0');
             $('.imgLogoJs').removeClass('hidden')
             $('.main-menu').addClass('!justify-around')
             menu.removeClass('top-[80%] lg:top-[100%]');
         } else {
             $('.imgLogoJs').addClass('hidden')
             menu.removeClass('fixed top-0');
             $('.main-menu').removeClass('!justify-around')
             menu.addClass('top-[80%] lg:top-[100%]');
         }
         $(window).scroll(function() {
             var menu = $('.main-menu-area');
             var scrollPosition = $(window).scrollTop(); // موقعیت اسکرول کاربر

             // وقتی کاربر کمی اسکرول به پایین کرد (مثلاً بعد از 100 پیکسل)
             if (scrollPosition > 100) {
                 menu.addClass('fixed top-0');
                 $('.imgLogoJs').removeClass('hidden')
                 $('.main-menu').addClass('!justify-around')
                 menu.removeClass('top-[80%] lg:top-[100%]');
             } else {
                 $('.imgLogoJs').addClass('hidden')
                 menu.removeClass('fixed top-0');
                 $('.main-menu').removeClass('!justify-around')
                 menu.addClass('top-[80%] lg:top-[100%]');
             }
         });
     });

     $(document).ready(function() {
         let isScrolling = false; // برای جلوگیری از تداخل با کدهای دیگر (در صورت وجود)
         let timerInterval; // تعریف سراسری برای timerInterval

         // باز کردن مودال با کلیک روی دکمه
         $('#openSuccessModal').click(function() {
             var $modal = $('#successModal');
             var $modalContent = $modal.find('.bg-white');

             $modal.removeClass('hidden');
             setTimeout(() => {
                 $modalContent.removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
             }, 50); // تاخیر کوتاه‌تر برای انیمیشن نرم‌تر

             // شروع تایمر
             startTimer();
         });

         // بستن مودال با کلیک روی دکمه بستن
         $('#closeSuccessModal').click(function() {
             closeModal();
         });

         // بستن مودال با کلیک روی بک‌دراپ (پس‌زمینه با بلور)
         $('#successModal').click(function(e) {
             if (e.target === this) {
                 closeModal();
             }
         });

         // تابع برای بستن مودال با انیمیشن
         function closeModal() {
             var $modalContent = $('#successModal .bg-white');
             $modalContent.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
             clearInterval(timerInterval); // متوقف کردن تایمر هنگام بستن مودال
             setTimeout(() => {
                 $('#successModal').addClass('hidden');
             }, 500); // تاخیر برابر با duration انیمیشن (500ms)
         }

         // تابع برای راه‌اندازی تایمر
         function startTimer() {
             let timeLeft = 5; // شروع از 5 ثانیه
             $('#timer').text(timeLeft);

             timerInterval = setInterval(() => {
                 timeLeft--;
                 if (timeLeft >= 0) { // فقط تا زمانی که timeLeft بزرگ‌تر یا برابر صفر است، شمارش ادامه می‌یابد
                     $('#timer').text(timeLeft);
                 } else {
                     clearInterval(timerInterval); // متوقف کردن تایمر وقتی timeLeft به صفر رسید
                     closeModal(); // بستن مودال خودکار
                 }
             }, 1000); // هر 1 ثانیه یک‌بار شمارش
         }
     });




     /*----------------------------
     		header middle short info Slider Active
     	------------------------------*/
     $(".header-middle-short-info").owlCarousel({
         loop: true,
         autoplay: true,
         smartSpeed: 1000,
         dots: false,
         nav: false,
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 2
             },
             1000: {
                 items: 3
             }
         }
     });

     /*----------------------------
    		hero Slider Active
    	------------------------------*/
     $(".tractor-main-slider").owlCarousel({
         loop: true,
         autoplay: true,
         animateOut: 'slideOutDown',
         animateIn: 'flipInX',
         dots: false,
         nav: true,
         navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: 1
             }
         }
     });

     $(".tractor-main-slider").on("translate.owl.carousel", function () {
         $(".tractor-single-slider h1, .tractor-single-slider p").removeClass("animated fadeInUp").css("opacity", "0");
         $(".tractor-single-slider .btnl").removeClass("animated fadeInDown").css("opacity", "0");
     });

     $(".tractor-main-slider").on("translated.owl.carousel", function () {
         $(".tractor-single-slider h1, .tractor-single-slider p").addClass("animated fadeInUp").css("opacity", "1");
         $(".tractor-single-slider .btnl").addClass("animated fadeInDown").css("opacity", "1");
     });

     /*----------------------------
     		about Slider Active
     	------------------------------*/
     $(".about-slider-wraper").owlCarousel({
         loop: true,
         autoplay: true,
         smartSpeed: 1000,
         dots: false,
         nav: true,
         navText: ["<span><i class='fa fa-long-arrow-left '></i> prev</span>", "<span>next <i class='fa fa-long-arrow-right '></i></span>"],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: 1
             }
         }
     });
     $(".about-slider-wraper").on("translate.owl.carousel", function () {
         $(".about-single-item h4").removeClass("animated fadeInUp").css("opacity", "0");
         $(".about-single-item h4").removeClass("animated fadeInDown").css("opacity", "0");
     });
     $(".about-slider-wraper").on("translated.owl.carousel", function () {
         $(".about-single-item h4").addClass("animated fadeInUp").css("opacity", "1");
         $(".about-single-item h4").addClass("animated fadeInDown").css("opacity", "1");
     });
     /*----------------------------
        		Counter Active
        	------------------------------*/
     // $('.counter').counterUp({
     //     delay: 2,
     //     time: 1000
     // });
     //
     // $('#bar1').barfiller({
     //     barColor: '#ffab00',
     //     duration: 3000
     // });
     // $('#bar2').barfiller({
     //     barColor: '#ffab00',
     //     duration: 3000
     // });
     // $('#bar3').barfiller({
     //     barColor: '#ffab00',
     //     duration: 3000
     // });
     // $('#bar4').barfiller({
     //     barColor: '#ffab00',
     //     duration: 3000
     // });

     /*----------------------------
     		Testimonial Active
     	------------------------------*/
     $(".all-testimonial-wraper").owlCarousel({
         loop: true,
         autoplay: false,
         smartSpeed: 1000,
         dots: false,
         nav: true,
         navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 1
             },
             1000: {
                 items: 1
             }
         }
     });
     /*----------------------------
     		scrolltop active
     	------------------------------*/
     $('body').materialScrollTop();
     /*----------------------------
     		popup active
     	------------------------------*/
     $(".video-view").magnificPopup({
         type: "iframe"
     });
     /*----------------------------
       		Client Slider Active
       	------------------------------*/
     $(".all-client-slider").owlCarousel({
         loop: true,
         autoplay: false,
         smartSpeed: 1000,
         dots: false,
         nav: true,
         navText: ["<i class='fa fa-angle-left '></i>", "<i class='fa fa-angle-right '></i>"],
         responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
         }
     });
     /*----------------------------
       		project Slider Active
       	------------------------------*/
     $(".project-slider").owlCarousel({
         loop: true,
         autoplay: false,
         smartSpeed: 1000,
         dots: false,
         nav: true,
         navText: ["<i class='fa fa-angle-left '></i>", "<i class='fa fa-angle-right '></i>"],
         responsive: {
             0: {
                 items: 1
             },
             600: {
                 items: 2
             },
             1000: {
                 items: 4
             }
         }
     });
     /*----------------------------
     		NiceSelect Active
     	------------------------------*/
     $('select').niceSelect();
     /*----------------------------
     		Price Filter Active
     	------------------------------*/
     $("#price-range").slider({
         range: true,
         min: 0,
         max: 500,
         values: [120, 388],
         slide: function (event, ui) {
             $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
         }
     });
     $("#amount").val("$" + $("#price-range").slider("values", 0) +
         " - $" + $("#price-range").slider("values", 1));
     /*----------------------------
        		main menu Active
        	------------------------------*/
     jQuery('#mobile-menu').meanmenu({
         meanMenuContainer: '.mobile-menu',
         meanScreenWidth: "991"
     });

     // WOW active
     new WOW().init();
 })(jQuery);