import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import login from './login.vue'
import Routes from './Routes.js'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueResource from 'vue-resource'
import Navigation from './Navigation'
import VueCookies from 'vue-cookies'


Vue.use(VueCookies)
Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(VueResource)

Vue.component('navigation',Navigation)
const router = new VueRouter({
   
   routes : Routes,
   mode   : 'history'
});

new Vue({
  el: '#app',
  render: h => h(App),
  router: router 
})
