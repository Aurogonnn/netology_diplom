// var goodsSwiper = new Swiper(".goodsSwiper", {
//     navigation: {
//         nextEl: ".swiper-button-next",
//         prevEl: ".swiper-button-prev",
//     },
//     slidesPerView: 2,
//     spaceBetween: 8,
//     breakpoints: {
//         950: {
//             slidesPerView: 3,
//             spaceBetween: 30
//         },
//         1370: {
//             slidesPerView: 4,
//             spaceBetween: 40
//         },
//         1800: {
//             slidesPerView: 5,
//             spaceBetween: 83,
//         }
//     }
// });
//
// var cityBikeSlider = new Swiper(".cityBikeSlider", {
//     navigation: {
//         nextEl: ".swiper-button-next",
//         prevEl: ".swiper-button-prev",
//     },
// });
//
// var favouriteSlider = new Swiper(".favouriteSlider", {
//     navigation: {
//         nextEl: ".swiper-button-next",
//         prevEl: ".swiper-button-prev",
//     },
//     slidesPerView: 2,
//     spaceBetween: 8,
//     breakpoints: {
//         950: {
//             slidesPerView: 3,
//             spaceBetween: 30
//         },
//         1370: {
//             slidesPerView: 3,
//             spaceBetween: 40
//         },
//         1500: {
//             slidesPerView: 3,
//             spaceBetween: 20
//         },
//         1800: {
//             slidesPerView: 3,
//             spaceBetween: 82,
//         }
//     }
// });


$('.slick-good-slider').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    adaptiveHeight: true,
    prevArrow:'<span class="slider__arrow slider__arrow--prev"></span>',
    nextArrow:'<span class="slider__arrow slider__arrow--next"></span>',
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 1500,
            settings: {
                slidesToShow: 4,
            }
        }
    ]
});

$('.slick-city-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true,
    prevArrow:'<span class="slider__arrow slider__arrow--prev"></span>',
    nextArrow:'<span class="slider__arrow slider__arrow--next"></span>',
});

$('.slick-favourite-slider').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    adaptiveHeight: true,
    prevArrow:'<span class="slider__arrow slider__arrow--prev"></span>',
    nextArrow:'<span class="slider__arrow slider__arrow--next"></span>',
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            }
        }
    ]
});
