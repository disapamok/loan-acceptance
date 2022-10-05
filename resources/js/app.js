require('./bootstrap');

window.Vue = require('vue');

// Add SweetAlert
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

Vue.component('loans',require('./components/loans.vue').default);
Vue.component('customers',require('./components/Customers.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.mixin({
    methods : {
        showAlert : function(message){
            this.$swal(message);
        },
        ask : function(title, message, callback){
            this.$swal({
                title: (title == null ? Locale[language].general.are_you_sure : title),
                text: message,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: Locale[language].general.do_it,
                cancelButtonText: Locale[language].general.cancel,
                closeOnConfirm: false,
                closeOnCancel: false
            }).then(callback);
        }
    }
});

const app = new Vue({
    el: '#app',
});
