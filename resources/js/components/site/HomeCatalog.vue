<template>
<div id="catalog-container">
    <aside>
        <ul id="categories-navigation" :class="{'fixed': $parent.navFixed}">
            <li v-for="(category, index) in categories" :key="index"><a @click.prevent="select_category(category.id)" :class="{'active': $store.state.selected_category == category}" href="#">{{category.name}}</a></li>
        </ul>
    </aside>
    <section>
        <div v-if="loading" class="flex items-center justify-center min-h-full">
            <div class="loader"></div>
        </div>
        <div v-if="!loading && (items.length > 0)" id="products-grid">
            <product-item v-for="item in items" :key="item.index" :item="item" class="col"></product-item>
        </div>
        <div v-if="!loading && (items.length < 1)">
            <span class="block text-center pt-5 pb-5">No se encontraron productos registrados.</span>
        </div>
        <div v-if="!loading && (items.length < total_count)" id="load-more-container">
            <button class="load-more">Cargar Más</button>
        </div>
    </section>
</div>
</template>

<script>
import { mapGetters, mapState } from 'vuex';
import HomeService from '../../services/home';
import ProductItem from '../../components/site/products/ProductItem';

export default {
    components: {
        'product-item': ProductItem
    },
    data() {
        return {
            items: [],
            total_count: 0,
            loading: true,
            params: {category_id: 0, page: 1},
            hs: new HomeService()
        }
    },
    computed: {
        ...mapState(['categories']),
        ...mapGetters(['selectedCategory'])
    },
    watch: {
        //
    },
    mounted() {
        this.params.category_id = (this.selectedCategory) ? +this.selectedCategory.id : 0;
        this.get_catalog();
    },
    methods: {
        select_category(id) {
            this.$store.dispatch('selectCategory', +id);
            this.params.category_id = (this.selectedCategory) ? +this.selectedCategory.id : 0;
            this.get_catalog();
        },
        get_catalog() {
            this.loading = true;
            this.hs.getCatalog(this.params).then(data => {
                this.items = data.items;
                this.total_count = data.total_count;
            }).catch().finally(() => {
                this.loading = false;
            });
        },
    }
}
</script>