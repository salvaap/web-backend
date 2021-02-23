import Home from './views/Home';
import About from './views/About';
import Account from './views/Account';
import Archive from './views/Archive';
import Product from './views/Product';
import NotFound from './views/NotFound';
import Checkout from './views/Checkout';

export default {
    base: '/home',
    mode: 'history',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/account',
            name: 'account',
            component: Account
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout
        },
        {
            path: '/product/:id',
            name: 'product',
            component: Product,
            props: route => ({id: +route.params.id})
        },
        {
            path: '/archive',
            name: 'archive',
            component: Archive,
            props: route => ({cid: +route.query.category_id})
        },
    ]
};