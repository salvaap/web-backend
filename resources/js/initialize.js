import Vue from 'vue';
import _ from 'lodash';
import Vuex from 'vuex';
import axios from 'axios';
import moment from 'moment';
import jQuery from 'jquery';
import numeral from 'numeral';
import Form from './core/Form';
import VueTheMask from 'vue-the-mask';
import Datepicker from 'vuejs-datepicker';

window._ = _;
window.Vue = Vue;
window.Form = Form;
window.Vuex = Vuex;
window.axios = axios;
window.jQuery = jQuery;
window.moment = moment;
window.numeral= numeral;
window.Datepicker = Datepicker;
window.VueTheMask = VueTheMask;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;

let token = document.head.querySelector('meta[name="csrf-token"]');

if(token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
