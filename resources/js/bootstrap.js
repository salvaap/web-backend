import Vue from 'vue';
import _ from 'lodash';
import axios from 'axios';
import moment from 'moment';
import jQuery from 'jquery';
import Vuetify from 'vuetify';
import Form from './core/Form';

window._ = _;
window.Vue = Vue;
window.axios = axios;
window.moment = moment;
window.jQuery = jQuery;
window.Form = Form;
window.Vuetify = Vuetify;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
