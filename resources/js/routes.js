import VueRouter from 'vue-router';

import Example2Component from './components/Example2Component';
import Bookables from './Bookables/BookablesList';
import Bookable from './Bookable/BookableItem';

const routes = [
    {
        path: '/',
        component: Bookables,
        name: 'home',
    },
    {
        path: '/second',
        component: Example2Component,
        name: 'second',
    },
    {
        path: '/bookable/:id',
        component: Bookable,
        name: 'bookable',
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,

});

export default router;