import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent'
import Example2Component from './components/Example2Component';

const routes = [
    {
        path: '/',
        component: ExampleComponent,
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