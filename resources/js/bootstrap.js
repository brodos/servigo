import _ from 'lodash';
import Vue from 'vue';
import axios from 'axios';
import moment from 'moment';
var Lightpick = require('lightpick');

// import jquery from 'jquery';
// import Echo from 'laravel-echo';

moment.locale('ro');

window._ = _;
window.Vue = Vue;
window.axios = axios;
window.moment = moment;
window.Lightpick = Lightpick;

// window.$ = window.jQuery = jquery;
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '9d28e385724eb9f07f85'
// });

// import bootstrap from 'bootstrap';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}