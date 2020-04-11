/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('@fortawesome/fontawesome-free/js/all.js');
require('bootstrap-table/dist/bootstrap-table.min.css');
require('bootstrap-table/dist/bootstrap-table.js');

require('tableexport.jquery.plugin');
require('bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js');
require('bootstrap-table/dist/extensions/print/bootstrap-table-print.min.js');

require('bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.min.css');
require('bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.min.js');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'bootstrap/dist/css/bootstrap.css';
import VueProgressBar from 'vue-progressbar';
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform';
import swal from 'sweetalert2';
import Toastr from 'vue-toastr';

const html2PDF = require('jspdf-html2canvas');
window.html2PDF = html2PDF;

window.Vue = require('vue');
window.Form = Form;

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.config.productionTip = false;



Vue.use(Toastr);

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
        toast.addEventListener('mouseenter', swal.stopTimer);
        toast.addEventListener('mouseleave', swal.resumeTimer);
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
    autoFinish: false,
    autoRevert: true,
    location: 'top',
    inverse: false
};
Vue.use(VueProgressBar, options);

window.Fire = new Vue();

Vue.filter('humanDate', (date) => moment(date).fromNow());

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
Vue.component('notify-user', require('./components/NotifyUser.vue').default);
Vue.component('account-activation', require('./components/AccountActivation.vue').default);
Vue.component('load-keys', require('./components/LoadKeys.vue').default);
Vue.component('print-key', require('./components/PrintKey.vue').default);
Vue.component('file-upload', require('./components/FileUpload.vue').default);



Vue.component('image-upload', require('./components/FormUpload').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

