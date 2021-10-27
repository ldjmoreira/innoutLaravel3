import Vue from 'vue';
import 'font-awesome/css/font-awesome.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './icofont/icofont.css'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

import router from './router';
import './config/msgs'
import store from './config/store'
import App from './components/App';


require('./bootstrap');

const app = new Vue({
    el: '#app',
    router,

    store,
    components: {
        App
    },


});
