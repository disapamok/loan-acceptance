require('./bootstrap');

window.Vue = require('vue');

Vue.component('loans',require('./components/loans.vue').default);
Vue.component('customers',require('./components/Customers.vue').default);

const app = new Vue({
    el: '#app',
});
