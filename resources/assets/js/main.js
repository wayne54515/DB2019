import Vue from 'vue'
// import App from './App.vue'
// import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
window.jQuery = require('jquery')

require('bootstrap-sass')

// window.Tether = require('tether')
// require('bootstrap')

// Vue.use(VueRouter)
Vue.use(VueAxios, axios)


Vue.component('food', require('./components/Food.vue'));
Vue.component('rank', require('./components/Rank.vue'));
Vue.component('manage', require('./components/Manage.vue'));

const app = new Vue({
    el: '#app'
});