import './bootstrap';
import vuetify from './plugins/vuetify'

import Login from './components/auth/Login';
import ListUsers from './components/users/ListUsers';
import ListValues from './components/values/ListValues';
import ListActions from './components/actions/ListActions';
import ListProducts from './components/products/ListProducts';
import ListProfiles from './components/profiles/ListProfiles';
import ListMerchants from './components/merchants/ListMerchants';
import CreateProduct from './components/products/CreateProduct.vue';
import ListAttributes from './components/attributes/ListAttributes';
import ListApplications from './components/applications/ListApplications';

import UploadFeaturedImage from './components/products/UploadFeaturedImage';
import UploadProductImages from './components/products/UploadProductImages';

Vue.component('login', Login);
Vue.component('list-users', ListUsers);
Vue.component('list-values', ListValues);
Vue.component('list-actions', ListActions);
Vue.component('list-products', ListProducts);
Vue.component('list-profiles', ListProfiles);
Vue.component('create-product', CreateProduct);
Vue.component('list-merchants', ListMerchants);
Vue.component('list-attributes', ListAttributes);
Vue.component('list-applications', ListApplications);
Vue.component('upload-featured-image', UploadFeaturedImage);
Vue.component('upload-product-images', UploadProductImages);

/* Dynamic Load in the Future */
import BarChart from './plugins/BarChart';
import DoughnutChart from './plugins/DoughnutChart';
import SalesHistory from './components/SalesHistory';
import SalesApplication from './components/SalesApplication';

Vue.component('bar-chart', BarChart);
Vue.component('doughnut-chart', DoughnutChart);
Vue.component('sales-history', SalesHistory);
Vue.component('sales-application', SalesApplication);
/* Dynamic Load in the Future */

/*Vue.component('edit-product', require('./components/products/EditProduct.vue').default);
Vue.component('sales-report', require('./components/reports/SalesReport.vue').default);
Vue.component('date-range', require('./components/reports/DateRange.vue').default);
Vue.component('create-application', require('./components/applications/CreateApplication.vue').default);
Vue.component('create-action', require('./components/actions/CreateAction.vue').default);
Vue.component('create-profile', require('./components/profiles/CreateProfile.vue').default);
Vue.component('edit-profile', require('./components/profiles/EditProfile.vue').default);
Vue.component('create-user', require('./components/users/CreateUser.vue').default);
Vue.component('create-product', require('./components/products/CreateProduct.vue').default);
Vue.component('create-attribute', require('./components/attributes/CreateAttribute.vue').default);
Vue.component('create-value', require('./components/values/CreateValue.vue').default);
Vue.component('register-merchant', require('./components/merchants/Register.vue').default);
Vue.component('commerce', require('./components/merchants/Commerce.vue').default);
Vue.component('edit-commerce', require('./components/merchants/EditCommerce.vue').default);
Vue.component('commerce-accounts', require('./components/merchants/Accounts.vue').default);
Vue.component('create-account', require('./components/merchants/CreateAccount.vue').default);*/

const app = new Vue({
    el: "#app",
    vuetify,
    data: {
        drawer: null
    },
    methods: {
        //
    }
});