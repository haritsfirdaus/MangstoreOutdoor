import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import McdAnimated from "../animated";
gsap.registerPlugin(ScrollTrigger);

const sideImageContent = document.querySelector('.side-image-content');
const latestCardWrapper = document.querySelector('.section-latest-posts .card-wrapper');

let latestPostTimeline = gsap.timeline({
    defaults: {
        duration: 0.5,
        opacity: 0.1
    },
    smoothChildTiming: true
});


if (sideImageContent && sideImageContent.querySelector('.img-wrapper img')) {
    McdAnimated.animateFromBlurScale(latestPostTimeline, 
        sideImageContent.querySelector('.img-wrapper img'),'+0.2',{
            duration: .6
        })
}

if (sideImageContent && sideImageContent.querySelector('.post-content')) {
    McdAnimated.animateFromRightToLeft(latestPostTimeline, sideImageContent.querySelector('.post-content'),'+0.1');
}

if (latestCardWrapper) {
    McdAnimated.animateFromBottomToTop(latestPostTimeline, '.section-latest-posts .card-wrapper .post-item','+0.1',{
        stagger: 0.2,
        duration: 1
    })
    McdAnimated.animateFromBottomToTop(latestPostTimeline, '.section-latest-posts .card-wrapper .post-item img','+0.1',{
        stagger: 0.2
    })
}

document.addEventListener('DOMContentLoaded', function(){
    var observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('swiper')) {
                    // Elemen masuk viewport, inisialisasi Swiper
                    new Swiper(entry.target, {
                        loop: false,
                        slidesPerView: 2.5,
                        spaceBetween: 10,
                    });
                }
                
                if (entry.target.classList.contains('category-loop')) {
                    let el = entry.target;
                    if (el.querySelector('svg')) {
                        McdAnimated.animateFromBottomToTop(categoriesLoopTimeline,el.querySelector('svg'),null, {
                            scrollTrigger: {
                                trigger: el,
                                start: "top 60%",
                            },
                        });
                    }
                    if (categoriesLoopTimeline,el.querySelector('.svg-img')) {
                        McdAnimated.animateFromBottomToTop(categoriesLoopTimeline,el.querySelector('.svg-img'),null, {
                            scrollTrigger: {
                                trigger: el,
                                start: "top 60%",
                            },
                        });
                    }
                    McdAnimated.animateFromBottomToTop(categoriesLoopTimeline,el.querySelector('h2'),null, {
                        scrollTrigger: {
                            trigger: el,
                            start: "top 60%",
                        },
                        filter: 'blur(5px)',
                        opacity: 0
                    });
                    McdAnimated.animateFromRightToLeft(categoriesLoopTimeline,el.querySelector('.post-permalink'),null, {
                        scrollTrigger: {
                            trigger: el,
                            start: "top 60%",
                        },
                        filter: 'blur(5px)',
                        opacity: 0
                    });

                    let cardGrid = el.querySelectorAll('a.post-item');
                    if (cardGrid) {
                        cardGrid.forEach(element => {
                            McdAnimated.animateFromRightToLeft(categoriesLoopTimeline,element,null, {
                                scrollTrigger: {
                                    trigger: el,
                                    start: "top 60%",
                                },
                                filter: 'blur(5px)',
                                opacity: 0,
                                duration: .5,
                                delay: 0.2
                            });
                        });
                    }
                }
                
                observer.unobserve(entry.target);
            }
        });
    });
    let categoriesLoopTimeline = gsap.timeline({
        smoothChildTiming: true
    });
    var swiperElements = document.querySelectorAll('.swiper');
    if (swiperElements) {
        swiperElements.forEach(function (element) {
            observer.observe(element);
        });
    }

    var cardElement = document.querySelectorAll('.category-loop');
    if (cardElement) {
        cardElement.forEach(function(el){
            observer.observe(el);
        })
    }
    
    
})