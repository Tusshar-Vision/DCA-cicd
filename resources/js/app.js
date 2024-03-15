// core version + navigation, pagination modules:
import Swiper from 'swiper';
import {Navigation} from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';

import '@dotlottie/player-component';

function initializeSwiper() {
    new Swiper('.swiper', {
        // configure Swiper to use modules
        modules: [Navigation],
        direction: 'horizontal',
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,

        breakpoints: {
            // 640: {
            //     slidesPerView: 1,
            // },
            768: {
                slidesPerView: 1,
            },
            1024: {
                slidesPerView: 2,
            },
            1280: {
                slidesPerView: 3,
            },
            1536: {
                slidesPerView: 3,
            }
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


}

// init Swiper:
const swiper = initializeSwiper();

window.addEventListener('onHomePage', () => {
    initializeSwiper();
});

// accordion toggle
const accordionItems= document.querySelectorAll(".vi-acrticle-highligh-coll");
    accordionItems.forEach(item =>
    item.addEventListener("click", () => {
        const isItemOpen = item.classList.contains("active");
        accordionItems.forEach(item => item.classList.remove("active"));
        if (!isItemOpen) {
        item.classList.toggle("active");
        }
    })
);
