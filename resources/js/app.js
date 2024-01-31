window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
const preloader = document.querySelector('.preloader');
document.addEventListener('DOMContentLoaded', function(){
    preloader.classList.remove('preloader__show');
})