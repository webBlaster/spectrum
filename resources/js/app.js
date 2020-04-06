/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueProgressBar from 'vue-progressbar';
import swal from 'sweetalert2';

window.Vue = require('vue');
window.events = new Vue();
window.flash = function(message) {
    window.events.$emit('flash', message);
};

window.swal = swal;
const toast  = swal.mixin({
    toast: true,
    position:'top-end',
    showConfirmButton:false,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    },
    timer:5000
});
window.toast = toast;

const options = {
    color:'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, options);

window.Fire = new Vue();


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('flash-error', require('./components/FlashError.vue').default);
Vue.component('flash-success', require('./components/FlashSuccess.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
