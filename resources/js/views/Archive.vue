<template>
  <div class="pt-header">
        <header class="w-full mb-4 py-20 bg-gray-200">
            <div class="flex flex-wrap justify-between container mx-auto">
                <h1 class="m-0">Comprar</h1>
                <p class="m-0">
                <router-link to="/" class="inline-block pr-2">
                    <span class="icon">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    </span>
                    <span>Inicio</span>
                </router-link>
                <span class="inline-block pr-2">/</span>
                <span class="">Comprar</span></p>
            </div>
        </header>
        <div class="container mx-auto pt-20">
            <div class="flex flex-wrap mb-10">
                <aside class="w-2/6 px-4">
                    <div class="mb-6 py-6 px-4 rounded shadow bg-white">
                        <div>
                            <div id="filter-search" class="w-100 pb-2 mb-6 border-b">
                                <div v-if="!loading_filters" class="mb-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address-city">
                                        Categorías
                                    </label>
                                    <div class="relative">
                                        <select v-model="params.sub_category" class="block appearance-none w-full bg-gray-200 border border-gray-400 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="sub_category" name="sub_category">
                                            <option :value="0">-- Categorías --</option>
                                            <option v-for="(category, index) in sub_categories" :key="index" :value="category.id">{{category.name}}</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="loading_filters" class="flex items-center justify-center h-24">
                                <div class="loader-sm"></div>
                            </div>
                            <div v-else class="mb-8">
                                <div>
                                    <!--<header class="flex mb-4"><span class="block text-sm font-bold uppercase">Filtros</span></header>-->
                                    <button @click.prevent="excecute_filters" class="btn btn-accent mb-6">Filtrar</button>
                                    <div id="filter-search-box" class="flex bg-gray-200 px-4 items-center rounded border mb-4">
                                        <span class="text-gray-900 flex-grow-0 mr-2">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        </span>
                                        <input type="search" class="flex-grow bg-transparent px-2 py-1 text-gray-700" placeholder="Buscar producto..." v-model="params.s">
                                    </div>
                                </div>
                                <div v-for="(attribute, j) in attributes" :key="j">
                                    <span class="block text-md mt-8 mb-4 font-bold">{{attribute.name}}</span>
                                    <label v-for="(value, k) in attribute.values" :key="k" class="select-none checkbox-container block relative cursor-pointer text-sm text-gray-800 font-semibold pl-8 mb-2">
                                        {{value.name}}
                                        <input class="absolute opacity-0 left-0 top-0 cursor-pointer" :id="value.id" :value="value.id" v-model="params.values" type="checkbox">
                                        <span class="h-6 w-6 checkmark absolute top-0 left-0 bg-gray-400"></span>
                                    </label>
                                </div>
                            </div>
                            <button @click.prevent="excecute_filters" class="btn btn-accent">Filtrar</button>
                        </div>
                    </div>
                </aside>
                <section class="w-4/6 px-4">
                    <div v-if="loading" class="flex items-center justify-center h-64">
                        <div class="loader"></div>
                    </div>
                    <div v-if="!loading && (items.length > 0)" id="products-grid" class="grid-3">
                        <product-item v-for="item in items" :key="item.index" :item="item" class="col"></product-item>
                    </div>
                    <div v-if="!loading && (items.length < 1)">
                        <span class="block text-center pt-5 pb-5">No se encontraron productos registrados.</span>
                    </div>
                    <div v-if="!loading && !full" id="load-more-container">
                        <button class="load-more" @click.prevent="load_more">Cargar Más</button>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import HomeService from '../services/home';
import { mapState, mapGetters } from 'vuex';
import StoreService from '../services/store';
import ProductItem from '../components/site/products/ProductItem';

export default {
  name: 'Archive',
  components: {
        'product-item': ProductItem
    },
  props: {
      cid: {
          type: Number,
          required: true
      }
    },
  data() {
    return {
      categories: [],
      sub_categories: [],
      attributes: [],
      items: [],
      original_items: [],
      total_count: 0,
      loading: true,
      loading_filters: true,
      params: {category_id: 0, page: 1, s: '', sub_category: 0, sub_categories: [], values: [], attributes: []},
      full: false,
      ss: new StoreService(),
      hs: new HomeService()
    }
  },
  watch: {
      'params.sub_category': function(val, old_val) {
          this.items = [];
          this.params.values = [];
          this.load_data();
      },
      '$route.query.category_id': function(val, old_val) {
          if(val && val != old_val) {
              this.items = [];
              this.params.sub_category = 0;
              this.params.values = [];
              this.load_data();
          }
      }
  },
  created() {
  },
  mounted() {
    this.params.category_id = (this.cid) ? this.cid : 0;
    this.$store.dispatch('selectCategory', this.cid);
    this.load_data();
  },
  computed: {
      ...mapState(['selected_category']),
      ...mapGetters(['getCategoryById'])
  },
  methods: {
      add_to_cart(variant, amount) {
          this.$parent.add_to_cart(variant, amount);
      },
      sum(variants) {
          return _.sumBy(variants, (v) => {return v.amount});
      },
      range(variants) {
          var first = _.head(variants);
          var last = _.last(variants);
          return (first.price == last.price) ? `US$ ${first.price}` : `US$ ${first.price} - US$ ${last.price}`;
      },
      load_data(){
          this.load_filters();
          this.load_items();
      },
      load_filters() {
          this.loading_filters = true;
          this.hs.getFilters({cid: +this.params.category_id, sub_cat: +this.params.sub_category}).then(data => {
              this.params.sub_categories = [];
              this.params.attributes = [];
              this.sub_categories = data.categories;
              _.forEach(data.attributes, (attribute, index) => {
                  this.params.attributes.push({id: attribute.id, values: []});
              });
              this.attributes = data.attributes;
          }).catch().finally(() => {
              this.loading_filters = false;
          });
      },
      load_items() {
          this.loading = true;
          this.full = false;
          let new_params = {category_id: this.params.category_id, sub_category: this.params.sub_category, page: this.params.page, s: this.params.s, values: JSON.stringify(this.params.values)}
          this.hs.getCatalog(new_params).then(data => {
              this.items = _.concat(this.items, data.items);
              this.total_count = data.total_count;
              if(this.items.length >= this.total_count) {
                  this.full = true;
              }
          }).catch().finally(() => {
              this.loading = false;
          });
      },
      excecute_filters() {
          this.params.page = 1;
          this.items = [];
          this.load_items();
      },
      load_more() {
          this.params.page++;
          this.load_items();
      }
  }
}
</script>