import Vue from 'vue';
import VueRouter from 'vue-router';
import VuePageTransition from 'vue-page-transition';
import inicioEstablecimiento from '../components/inicioEstablecimiento';
import mostrarEstablecimiento from '../components/mostrarEstablecimiento';

const routes = [
    {
        path: '/',
        component: inicioEstablecimiento
    },
    {
        path: '/establecimiento/:id',
        name: 'establecimiento',
        component: mostrarEstablecimiento
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueRouter);
Vue.use(VuePageTransition);

export default router;
