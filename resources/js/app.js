require('./bootstrap');
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import Index from './index';
import router from './routes';
import moment from 'moment';
import StarRating from './shared/components/StarRating';
import NotFound from './shared/components/NotFound';
import FatalError from './shared/components/fatalError';
import ValidationsError from './shared/components/ValidationsErrors';
import LoadingIndicator from './shared/components/LoadingIndicator';
import Success from './shared/components/Success';
import storeDeginition from './store';


window.Vue = require('vue');

Vue.use(VueRouter, Vuex);
Vue.component('star-rating', StarRating);
Vue.component('not-found', NotFound);
Vue.component('fatal-error', FatalError);
Vue.component('success', Success);
Vue.component('v-errors', ValidationsError);
Vue.component('loading-indicator', LoadingIndicator);


Vue.filter('fromNow', value => {
    return moment(value).fromNow();
});

const store = new Vuex.Store(storeDeginition);

window.axios.interceptors.response.use(
  response => response,
  error => {
      if(401 === error.response.status) {
          store.dispatch('logout');
      }
      return Promise.reject(error);
  }
);

const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        index: Index,
    },
    async beforeCreate() {
        this.$store.dispatch('loadStoredState');
        this.$store.dispatch('loadUser');
    }

});
