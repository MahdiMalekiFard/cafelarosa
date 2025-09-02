// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  const swiperElement = document.querySelector('.mySwiper');
  const slides = document.querySelectorAll('.mySwiper .swiper-slide');
  
  if (swiperElement && slides.length > 0) {
    var swiper1 = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 0,
      loop: false,
      autoplay: slides.length > 1 ? {
        delay: 5000,
        disableOnInteraction: false,
      } : false,
      pagination: slides.length > 1 ? {
        el: ".mySwiper .swiper-pagination",
        clickable: true,
        dynamicBullets: false,
      } : false,
      navigation: {
        nextEl: ".next-swiper",
        prevEl: ".prev-swiper",
      },
      on: {
        init: function() {
          // Hide pagination if only one slide
          if (this.slides.length <= 1) {
            const pagination = document.querySelector('.mySwiper .swiper-pagination');
            if (pagination) {
              pagination.style.display = 'none';
            }
          }
        }
      }
    });
  }
});


  var swiper = new Swiper(".mySwiper3", {
    slidesPerView: 1,
    spaceBetween: 0,
    navigation: {
      nextEl: ".next-swiper3",
      prevEl: ".prev-swiper3",
    }
  });
  var swiper = new Swiper(".testimonialSwiper", {
    spaceBetween: 30,
    pagination: {
      el: ".testimonials-pagination",
      clickable: true,
    },
  });

  var swiper = new Swiper(".blogSwiper", {
    
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      991: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
  });

  
  var swiper = new Swiper(".popularSwiper", {
    
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      991: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
  });
  var swiper = new Swiper(".partner-type-6", {
      direction: "horizontal",
      effect: "slide",
      slidesPerView: 2,
      loop: true,
      spaceBetween: 68.95,
      breakpoints: {
        500: {
          slidesPerView: 3,
        },
        800: {
          slidesPerView: 4,
        },
        1200: {
          slidesPerView: 5,
        },
        1600: {
          slidesPerView: 6,
        },
      },
      autoplay: {
        delay: 3000,
      },
    });

  var swiper = new Swiper(".swiperchoose", {
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  var swiper = new Swiper(".testimonialPortfolio", {
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    

    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 0,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 0,
      },
    },
  });

  var swiper = new Swiper(".testimonialPortfolio1", {
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    

    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
  });

  var swiper = new Swiper(".testimonialPortfolio3", {

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    

   
  });

  
  var swiper = new Swiper(".testimonialPortfolio4", {

    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 30,
      },
      991: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1440: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },

   
  });

   var swiper = new Swiper(".testimonialPortfolio3", {

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    

   
  });


  var swiper = new Swiper(".aboutSwiper", {

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    
  });

  var swiper = new Swiper(".imagesSwiper", {
    centeredSlides: true,
    loop: true,
    spaceBetween: 30,
    slidesPerView: 1,
    breakpoints: {
  
      768: {
        slidesPerView: 1.5,
      },
      991: {
        slidesPerView: 2.42,
      },
    },
  });