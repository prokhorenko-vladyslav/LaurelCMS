/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vuex from "vuex";
import Vuelidate from 'vuelidate';
import { BootstrapVue } from 'bootstrap-vue';
import Vue from 'vue'
import Notifications from 'vue-notification'

window.Vue = require('vue');
Vue.use(Vuex);
Vue.use(Vuelidate);
Vue.use(BootstrapVue);
Vue.use(Notifications);

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from "./router/router";
import store from "./store/store";
import vuetify from './plugins/vuetify';

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
}

window.composeRoute = function (route, parameters = {}, isExternal = false) {
    // add to composing parameters and isExternal option
    let routeUri = window.apiRoutes[route];

    if (parameters.replace) {
        Object.keys(parameters.replace).forEach( replacable => {
            routeUri = routeUri.split(`{${replacable}}`).join(parameters.replace[replacable]);
        });
    }

    return routeUri;
};

Vue.prototype.composeRoute = window.composeRoute;

const app = new Vue({
    router,
    store,
    vuetify
}).$mount('#app');
