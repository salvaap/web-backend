import './initialize';
import 'vue-range-component/dist/vue-range-slider.css'

import PortalVue from 'portal-vue';
import VueRouter from 'vue-router';
import VueRangeSlider from 'vue-range-component'
import VueObserveVisibility from 'vue-observe-visibility';

import routes from './routes';
import store from './store/store';

import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/en'

import App from './App.vue';
import Login from './components/Login';
import Modal from './components/Modal';
import Tab from './components/Tab.vue';
import Cart from './components/Cart.vue';
import Tabs from './components/Tabs.vue';
import Input from './components/Input.vue';
import Dropdown from './components/Dropdown';
import Select from './components/Select.vue';
import Categories from './components/Categories';
import DateSelect from './components/DateSelect.vue';
import HomeCatalog from './components/site/HomeCatalog';
import Images from './components/site/products/Images.vue';
import Payment from "./views/Payment";

import { currency } from './filters/numeral';

Vue.use(PortalVue);
Vue.use(VueRouter);
Vue.use(VueTheMask);
Vue.use(VueRangeSlider);
Vue.use(VueObserveVisibility);

Vue.use(Element, { locale })

Vue.component('App', App);
Vue.component('Tab', Tab);
Vue.component('Cart', Cart);
Vue.component('Tabs', Tabs);
Vue.component('Input', Input);
Vue.component('Login', Login);
Vue.component('Modal', Modal);
Vue.component('Select', Select);
Vue.component('dropdown', Dropdown);
Vue.component('Categories', Categories);
Vue.component('datepicker', Datepicker);
Vue.component('DateSelect', DateSelect);
Vue.component('product-images', Images);
Vue.component('home-catalog', HomeCatalog);
Vue.component('Payment', Payment);

Vue.filter('price', currency);

const router = new VueRouter(routes);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        //
    },
    directives: {
        //
    },
    data: {
        //
    },
    methods: {
        //
    }
});
