import VueRouter from 'vue-router';


import Bookables from './bookables/BookablesList';
import Bookable from './bookable/BookableItem';
import Review from './review/Review';
import BookingList from './booking/BookingList';
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
        path: '/booking-list/:id',
        component: BookingList,
        name: 'booking-list'
    },
    {
        path: '*',
        component: NotFound,
        name: 'not-found'
    },

];

const router = new VueRouter({
    mode: 'history',
    routes: routes,

});

export default router;