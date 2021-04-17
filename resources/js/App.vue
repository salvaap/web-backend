<template>
  <div id="app">
    <div id="main-container">
      <div id="header-container" :class="(menuFixed || $route.name !== 'home') ? 'scrolled' : ''">
        <div id="header-brand">
          <h1 id="logo"><router-link to="/">Salva<span class="accent">App</span></router-link></h1>
          <Categories class="inline-block min-w-dropdown" :items="c" :unselected_label="ul" :has_label="hl" :label_text="lt"></Categories>
        </div>
        <div id="header-search" class="w-100 px-4">
          <div id="header-search-box" class="flex bg-gray-200 px-4 items-center rounded border">
            <span class="text-gray-900 flex-grow-0 mr-2">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </span>
            <input type="search" class="flex-grow bg-transparent px-2 py-1 text-gray-700" placeholder="Busca tu producto acá...">
          </div>
        </div>
        <div id="header-menu">
          <a href="#" class="inline-block font-semibold mr-8 text-primary-500 hover:text-primary-900">
            <span class="icon">
              <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
              </svg>
            </span>
            <span>Ofertas</span>
          </a>
          <a href="/dashboard" class="inline-block font-semibold mr-8 text-primary-500 hover:text-primary-900">
            <span class="icon">
              <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </span>
            <span>Vender</span>
          </a>
          <dropdown v-if="$store.state.user" align="right" width="200px">
              <template v-slot:trigger>
                  <a class="inline-block font-semibold text-primary-500 hover:text-primary-900" ><span>Hola, {{user.first_name}}</span></a>
              </template>
              <ul>
                <li><router-link to="/account" class="dropdown-menu-link">Mi Perfil</router-link></li>
              </ul>
              <hr>
              <a class="dropdown-menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Cerrar Sesión</span></a>
              <form id="logout-form" action="/logout" method="POST" style="display: none;"></form>
          </dropdown>
          <!--<Login v-else></Login>-->
          <a v-else @click.prevent="open" class="inline-block font-semibold mr-8 text-primary-500 hover:text-primary-900">Iniciar Sesión</a>
        </div>
      </div>
      <router-view :key="$route.fullPath"/>
      <div style="z-index: 100;" class="flex justify-between relative w-full px-4 py-4 bg-primary-800">
        <p class="text-center text-sm text-white mb-0">Derechos Reservados SalvaApp. {{ year }}</p>
        <p class="text-center text-sm mb-0 text-white"><a class="inline-block mr-2 text-gray-400 hover:text-white" href="#">Politicas de Privacidad</a><span class="inline-block mr-2">|</span><a class="inline-block mr-2 text-gray-400 hover:text-white" href="#">Terminos y Condiciones</a><span class="inline-block mr-2">|</span><a class="inline-block text-gray-400 hover:text-white" href="#">Devoluciones</a></p>
      </div>
    </div>
    <portal-target name="modals"></portal-target>
    <Modal ref="loginModal">
      <template v-slot:header>
        <h2 class="text-center text-2xl font-extrabold text-primary-500">Ingresa a tu cuenta</h2>
      </template>
      <template v-slot:body>
        <Login />
      </template>
    </Modal>
    <NotificationContainer />
    <ProductModal />
    <Cart v-if="$route.name !== 'checkout'" />
  </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex';
import NotificationContainer from './components/site/notifications/container';
import ProductModal from './components/site/products/ProductModal';

export default {
  name: 'App',
  components: {
    NotificationContainer,
    ProductModal,
  },
  props: {
    c: {
      type: Array,
      default: []
    }, 
    u: {
      type: Object,
      default: null
    }},
  data() {
    return {
      menuFixed: false,
      error_cart: false,
      ul: 'Categorías',
      hl: false,
      lt: null
    }
  },
  computed: {
    year() {
      return moment().format('YYYY');
    },
    ...mapGetters(['getCategoryById']),
    ...mapState(['user', 'categories'])
  },
  created() {
    this.$store.dispatch('setCategories', this.c);
    this.$store.dispatch('cart/get').then(() => {}).catch(() => {});
    if(this.u) {
      this.$store.dispatch('setUser', this.u);
    }
  },
  mounted() {
    //
  },
  methods: {
    open() {
      this.$refs.loginModal.openModal();
    }
  }
}
</script>
