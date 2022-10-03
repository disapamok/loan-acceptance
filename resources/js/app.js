require('./bootstrap');

window.Vue = require('vue');

Vue.component('loans',require('./components/loans.vue').default);
Vue.component('customers',require('./components/Customers.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app',
});
