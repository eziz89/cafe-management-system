document.addEventListener('DOMContentLoaded', () => {

    new Swiper('.categorySwiper', {

        modules: [
            Navigation,
            Pagination,
            Autoplay
        ],

        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 20,
            },

            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },

            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            }
        }

    });

});