import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import McdAnimated from "./animated";
gsap.registerPlugin(ScrollTrigger);

const footerElement = document.querySelector('footer.footer');
const footerCol2 = document.querySelector('.footer-column-2');
const footerCol3 = document.querySelector('.footer-column-3');
let footerTimeline = gsap.timeline( { });

if (footerElement) {
    footerTimeline.add('companyInfo', gsap.from('.company-info', {
        y: 50,
        duration: 0.5,
        stagger:0.2,
        scrollTrigger: {
            trigger: footerElement,
            start: 'top 80%'
        }
    }));

    footerTimeline.add('footer-logo',gsap.from('.footer-logo', {
        opacity: 0,
        duration: 0.5,
        filter:'blur(3px)',
        scrollTrigger: {
            trigger: '.footer-logo',
            start: 'top 90%'
        }
    }));

    footerTimeline.add('menu-label', gsap.from('.footer-column-2 .label', {
        opacity: 0,
        duration: 0.5,
        filter:'blur(3px)',
        scrollTrigger: {
            trigger: '.footer-column-2',
            start: 'top 80%'
        },
        delay: 0.3
    }));

    footerTimeline.add('footer-menus', gsap.from('.footer-menu-item', {
        opacity: 0,
        y:50,
        duration: 0.5,
        stagger: 0.2,
        scrollTrigger: {
            trigger: '.footer-menus',
            start: 'top 80%'
        },
        delay: 0.4
    }));

    footerTimeline.add('menu-label', gsap.from('.footer-column-3 .label', {
        opacity: 0,
        duration: 0.5,
        filter:'blur(3px)',
        scrollTrigger: {
            trigger: '.footer-column-3',
            start: 'top 80%'
        },
        delay: 0.5
    }));

    footerTimeline.add('partners', gsap.from('.partner-item', {
        opacity: 0,
        filter: 'blur(3px)',
        duration: 0.5,
        stagger: 0.2,
        scrollTrigger: {
            trigger: '.partners',
            start: 'top 80%'
        },
        delay: 0.5
    }));
}