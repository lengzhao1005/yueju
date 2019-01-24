
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.canuse
 */

Vue.component('example-show-component', require('./components/ExampleComponent.vue'));
//Vue.component('heart-use-component', require('./components/HeartUseComponent'));


const app = new Vue({
    el: '#app'
});
