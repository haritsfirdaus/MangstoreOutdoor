window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";


console.log("ini dari app.js")

const searchForm = document.querySelector('.form-search');