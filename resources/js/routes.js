import VueRouter from 'vue-router';


import Bookables from './bookables/BookablesList';
import Bookable from './bookable/BookableItem';
import Review from './review/Review';

const routes = [
    {
        path: '/',
        component: Bookables,
        name: 'home',
    },
    {
        path: '/bookables/:id',
        component: Bookable,
        name: 'bookable',
    },
    {
        path: '/review/:id',
        component: Review,
        name: 'review'
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,

});

export default router;