import Vue from 'vue';
import VueRouter from 'vue-router';

import auth from '@websanova/vue-auth/src/v2.js';
import driverAuthBearer from '@websanova/vue-auth/src/drivers/auth/bearer.js';
import driverHttpAxios from '@websanova/vue-auth/src/drivers/http/axios.1.x.js';
import driverRouterVueRouter from '@websanova/vue-auth/src/drivers/router/vue-router.2.x.js';

import './plugins';
import './plugins/global-components';

import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './plugins/store';
import App from './App.vue';

import { routes } from './routes';

Vue.use(VueAxios, axios);
Vue.use(VueRouter);
window.axios = axios;

axios.defaults.baseURL = `${window.baseUrl}/api/`;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const router = new VueRouter({
  mode: 'history',
  routes,
  linkExactActiveClass: 'active',
});

Vue.use(auth, {
  plugins: {
    http: Vue.axios,
    router,
  },
  drivers: {
    auth: driverAuthBearer,
    http: driverHttpAxios,
    router: driverRouterVueRouter,
  },
  options: {
    loginData: {
      url: 'auth/login',
      method: 'POST',
    },
    registerData: {
      url: 'auth/register',
      method: 'POST',
    },
    fetchData: {
      url: 'auth/user',
      method: 'GET',
    },
    authRedirect: {
      path: '/auth/login',
    },
  },
});

const app = new Vue({
  el: '#app',
  router,
  store,
  render: (h) => h(App),
});
