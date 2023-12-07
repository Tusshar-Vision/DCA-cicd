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

// text lenght for whats new section

function truncateText(selector, maxLength = 50) {
    let elements = document.querySelectorAll(selector);
    for(let i= 0; i < elements.length; i++) {
        elements[i].innerText = elements[i].innerText.substr(0, maxLength) + '...';
    }
    return truncated;
}

truncateText(".limited-text");

// search dropdown js

// const onfocus = document.querySelector('.focus');
// const showlist = document.querySelector('.updatedText');

// onfocus.addEventListener("focus", () => {
//   showlist.style.display = 'block';
// });

// onfocus.addEventListener("blur", () => {
//   showlist.style.display = 'none';
// });


// copy link js
