require('./bootstrap');

window.Vue = require('vue');
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('loans',require('./components/loans.vue').default);

const app = new Vue({
    el: '#app',
});
