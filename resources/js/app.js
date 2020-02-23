require('./bootstrap');
import VueRouter from 'vue-router';
import Index from './index';
import router from './routes';
import moment from 'moment';
import StarRating from './shared/components/StarRating'
import NotFound from './shared/components/NotFound'
import FatalError from './shared/components/fatalError'
import ValidationsError from './shared/components/ValidationsErrors'

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.component('star-rating', StarRating);
Vue.component('not-found', NotFound);
Vue.component('fatal-error', FatalError);
Vue.component('v-errors', ValidationsError);


Vue.filter('fromNow', value => {
    return moment(value).fromNow();
});

const app = new Vue({
    el: '#app',
    router,
    components: {
        index: Index,
    }

});
