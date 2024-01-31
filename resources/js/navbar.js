import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import McdAnimated from "./animated";
gsap.registerPlugin(ScrollTrigger);

const navElement = document.querySelector('#masthead nav');
const searchForm = document.querySelector('.search-input');
let navbarTimeline = gsap.timeline(
{
    defaults:
    {
        duration: 0.5
    },
    paused: true
});

if (navElement) {
    McdAnimated.animateFromBottomToTop(navbarTimeline,navElement);
}
if (searchForm) {
    McdAnimated.animateFromBottomToTop(navbarTimeline,searchForm);
}

document.addEventListener('DOMContentLoaded', function(){
    navbarTimeline.play();
})