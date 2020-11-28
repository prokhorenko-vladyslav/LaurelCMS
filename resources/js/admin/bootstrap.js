import store from "./store/store";

window._ = require('lodash');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.interceptors.request.use(function (config) {
    if (store.getters["Admin/Auth/getToken"]) {
        config.headers.Authorization = `Bearer ${store.getters["Admin/Auth/getToken"]}`;
    }
    return config;
}, function (error) {
    return Promise.reject(error);
});

window.axios.interceptors.response.use(function (response) {
    if (response.data.notifications) {
        showNotifications(response.data.notifications);
    }
    return response;
}, function (error) {
    if (error.response.data.notifications) {
        showNotifications(error.response.data.notifications);
    }
    return Promise.reject(error);
});

let showNotifications = function (notifications) {
    notifications.forEach( notification => {
        Vue.notify({
            group: 'dashboard',
            type: notification.type,
            title: notification.message,
            duration: notification.duration * 1000
        });
    });
}

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
    auth: {
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('api_token')
        },
    },
});

import VueRouter from 'vue-router';

window.Vue.use(VueRouter)
