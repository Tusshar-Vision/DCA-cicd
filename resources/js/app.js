// core version + navigation, pagination modules:
import Swiper from 'swiper';
import {Autoplay, FreeMode, Navigation} from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import '@dotlottie/player-component';

function initializeSwiper() {
    new Swiper('.swiper-featured', {
        // configure Swiper to use modules
        modules: [Navigation, Autoplay],
        direction: 'horizontal',
        autoplay: {
            delay: 10000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,
        slidesPerGroup: 1,

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

function initializeInitiativeSwiper() {
    new Swiper('.swiper-initiative', {
        // configure Swiper to use modules
        modules: [Navigation, Autoplay],
        direction: 'horizontal',
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,
        slidesPerGroup: 1,

        breakpoints: {
            768: {
                slidesPerView: 5,
                slidesPerGroup: 3,
            },
            1024: {
                slidesPerView: 5,
                slidesPerGroup: 3,
            },
            1280: {
                slidesPerView: 5,
                slidesPerGroup: 3,
            },
            1536: {
                slidesPerView: 5,
                slidesPerGroup: 3,
            }
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-initiative-next',
            prevEl: '.swiper-button-initiative-prev',
        },
    });


}

// init Swiper:
const swiperInitiative = initializeInitiativeSwiper();

window.addEventListener('onHomePage', () => {
    initializeSwiper();
    initializeInitiativeSwiper();
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

window.getData = async function (url) {
    // Construct a unique cache key based on the URL
    const cacheKey = `cache-${encodeURIComponent(url)}`;

    // Try to get cached data from localStorage
    const cachedData = localStorage.getItem(cacheKey);

    if (cachedData) {
        const { data, expiry } = JSON.parse(cachedData);

        // Check if the cached data is still valid based on an expiry time
        const now = new Date();

        if (now.getTime() < expiry) {
            // Cached data is still valid, return it instead of fetching
            return data;
        } else {
            // Cached data has expired, remove it from localStorage
            localStorage.removeItem(cacheKey);
        }
    }

    // Cached data is not available or has expired, fetch new data
    const response = await fetch(url);
    const data = await response.json();

    // Set a new expiry time for the cached data (e.g., 1 minute from now)
    const expiry = new Date().getTime() + (60 * 1000); // 1 minute in milliseconds

    // Store the fetched data in localStorage with the expiry time
    localStorage.setItem(cacheKey, JSON.stringify({ data, expiry }));

    return data;
}

window.saveData = async function (url, data) {
    try {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        });
        return await response.json();
    } catch (error) {
        console.error("Error:", error);
    }
}

// In your Alpine.js initialization
Alpine.data('fontSizeManager', () => ({
    fontSize: parseFloat(localStorage.getItem('fontSize')) || 1,

    init() {
        this.$watch('fontSize', (newSize) => {
            localStorage.setItem('fontSize', newSize);
            this.updateFontSize(newSize);
        });

        window.addEventListener('font-size-changed', (event) => {
            this.fontSize = event.detail;
        });
    },

    updateFontSize(size) {
        document.querySelectorAll('.ck-content').forEach(el => {
            el.style.fontSize = `${size}rem`;
        });
    }
}));
