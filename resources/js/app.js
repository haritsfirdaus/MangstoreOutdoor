window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
const preloader = document.querySelector('.preloader');
new PerformanceObserver((list) => {
    const latestEntry = list.getEntries().at(-1);
  
    if (latestEntry?.element?.getAttribute('loading') == 'lazy') {
        
    }
  }).observe({type: 'largest-contentful-paint', buffered: true});
  
document.addEventListener('DOMContentLoaded', function(){
    preloader.classList.remove('preloader__show');
})