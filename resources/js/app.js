// core version + navigation, pagination modules:
import Swiper from 'swiper';
import {Navigation} from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';

function initializeSwiper() {
    new Swiper('.swiper', {
        // configure Swiper to use modules
        modules: [Navigation],
        direction: 'horizontal',
        loop: true,
        slidesPerView: 2,
        spaceBetween: 20,

        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 2,
            },
            1280: {
                slidesPerView: 2,
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

// remove tag function
var container = document.getElementById('note-tag');
container.addEventListener('click', function (event) {
    const span = document.getElementById(event.target.id + "span");
    span.remove()
});



// text lenght for whats new section

// search dropdown js

// const onfocus = document.querySelector('.focus');
// const showlist = document.querySelector('.updatedText');

// onfocus.addEventListener("focus", () => {
//   showlist.style.display = 'block';
// });

// onfocus.addEventListener("blur", () => {
//   showlist.style.display = 'none';
// });


// accordion toggle
const accordionItems = document.querySelectorAll(".vi-acrticle-highligh-coll");
    accordionItems.forEach(item =>
    item.addEventListener("click", () => {
        const isItemOpen = item.classList.contains("active");
        accordionItems.forEach(item => item.classList.remove("active"));
        if (!isItemOpen) {
        item.classList.toggle("active");
        }
    })
);