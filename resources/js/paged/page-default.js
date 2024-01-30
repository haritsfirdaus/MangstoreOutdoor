document.addEventListener('DOMContentLoaded',function(e){
    // init swiper mobile latest posts
    // let cardSlider = document.querySelector('.swiper');
    // const swiper = new Swiper(cardSlider, {
    // loop: false,
    // slidesPerView: 2.5,
    // spaceBetween: 10,
    // });

    var observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Elemen masuk viewport, inisialisasi Swiper
                new Swiper(entry.target, {
                    loop: false,
                    slidesPerView: 2.5,
                    spaceBetween: 10,
                });

                // Unobserve elemen setelah diinisialisasi
                observer.unobserve(entry.target);
            }
        });
    });

    // Dapatkan semua elemen dengan class "swiper"
    var swiperElements = document.querySelectorAll('.swiper');

    // Observe setiap elemen
    swiperElements.forEach(function (element) {
        observer.observe(element);
    });
});