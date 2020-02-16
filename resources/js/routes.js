import VueRouter from 'vue-router';

import Example2Component from './components/Example2Component';
import Boockables from './Bookables/BookablesList';

const routes = [
    {
        path: '/',
        component: Boockables,
        name: 'home',
    },
    {
        path: '/second',
        component: Example2Component,
        name: 'second',
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,

});

export default router;