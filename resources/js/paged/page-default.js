import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

const preloader = document.querySelector('.preloader');
const searchForm = document.querySelector('.search-input');
const navElement = document.querySelector('#masthead nav');
const sideImageContent = document.querySelector('.side-image-content');
const latestCardWrapper = document.querySelector('.card-wrapper');

function animateBlurBottomToTop(timeline,selector, startAt = '<0.1', fromProps, toProps) {
    timeline.fromTo(
        selector,
        {
            ...fromProps,
            opacity:  fromProps && fromProps.opacity ? fromProps.opacity :  .5,
            y:  fromProps && fromProps.y ? fromProps.y :  10,
            filter:  fromProps && fromProps.filter ? fromProps.filter :  'blur(5px)'
        },
        {
            ...toProps,
            opacity:  toProps && toProps.opacity ? toProps.opacity :  1,
            y:  toProps && toProps.y ? toProps.y :  0,
            filter:  toProps && toProps.filter ? toProps.filter :  'blur(0px)',
        },
        startAt
    );
}

function animateRightToLeft(timeline,selector, startAt = '<0.1', fromProps, toProps) {
    timeline.fromTo(
        selector,
        {
            ...fromProps,
            x:10,
        },
        {
            ...toProps,
            opacity:1,
            x:0,
        },
        startAt
    );
}
let navbarTimeline = gsap.timeline(
    { defaults: 
        { 
            duration: 0.5
        } 
    });

if (navElement) {
    animateBlurBottomToTop(navbarTimeline,navElement);
}

if (searchForm) {
    animateBlurBottomToTop(navbarTimeline,searchForm);
}

let latestPostTimeline = gsap.timeline({
    defaults: {
        duration: 0.5,
        opacity: 0.1
    },
    paused: true,
    smoothChildTiming: true
});

if (sideImageContent && sideImageContent.querySelector('.img-wrapper')) {
    animateBlurBottomToTop(latestPostTimeline, 
        sideImageContent.querySelector('.img-wrapper'), 
        '0',
        {
            filter: 'blur(10px)'
        },
        {
            duration: 1
        });
}

if (sideImageContent && sideImageContent.querySelector('.post-content')) {
    animateRightToLeft(latestPostTimeline, sideImageContent.querySelector('.post-content'),'<0.2');
}

if (latestCardWrapper) {
    gsap.fromTo(".post-item", 
    {
        y: 50,
    },
    {
        y: 0,
        stagger: 0.2
    });
}

navbarTimeline.pause();
document.addEventListener('DOMContentLoaded', function(){
    preloader.classList.remove('preloader__show');
    navbarTimeline.play();
    latestPostTimeline.play();

    var observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Elemen masuk viewport, inisialisasi Swiper
                new Swiper(entry.target, {
                    loop: false,
                    slidesPerView: 2.5,
                    spaceBetween: 10,
                });
                observer.unobserve(entry.target);
            }
        });
    });
    var swiperElements = document.querySelectorAll('.swiper');
    swiperElements.forEach(function (element) {
        observer.observe(element);
    });
    
    
})