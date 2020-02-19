require('./bootstrap');
import VueRouter from 'vue-router';
import Index from './index';
import router from './routes';
import moment from 'moment';
import StarRating from './shared/components/StarRating'

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.component('star-rating', StarRating);

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
