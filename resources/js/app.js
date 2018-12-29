/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('app-label', require('./components/Label.vue'));
Vue.component('basic-chart', require('./components/Charts/Chart'));
Vue.component('app-select', require('./components/SelectInput'));

Vue.component('obs-attach', require('./components/ObsAttach.vue'));
// Vue.component('subscribers-input', require('./components/SubscribersInput.vue'));

const app = new Vue({
    el: '#app',
    data: {
        selected: null
    }
});
