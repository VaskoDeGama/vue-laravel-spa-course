import VueRouter from 'vue-router';


import Bookables from './bookables/BookablesList';
import Bookable from './bookable/BookableItem';
import Review from './review/Review';
import NotFound from "./shared/components/NotFound";

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
    },
    {
        path: '*',
        component: NotFound,
        name: 'not-found'
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,

});

export default router;