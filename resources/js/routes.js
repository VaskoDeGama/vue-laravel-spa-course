import VueRouter from 'vue-router';


import Bookables from './bookables/BookablesList';
import Bookable from './bookable/BookableItem';
import Review from './review/Review';
import NotFound from "./shared/components/NotFound";
import Basket from "./basket/Basket";


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
        path: '/basket',
        component: Basket,
        name: 'basket'
    },
    {
        path: '/auth/login',
        component: require('./auth/Login').default,
        name: 'Login'
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