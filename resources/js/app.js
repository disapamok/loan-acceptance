require('./bootstrap');

window.Vue = require('vue');

Vue.component('loans',require('./components/loans.vue').default);

const app = new Vue({
    el: '#app',
});
