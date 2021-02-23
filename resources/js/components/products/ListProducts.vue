<template>
<div class="block">
    <v-data-table :page.sync="page" :headers="headers" :items="items" :items-per-page="items_per_page" :options.sync="options" :server-items-length="total_count" :loading="loading_items" hide-default-footer class="elevation-1">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Productos</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-text-field @keydown="searchItems" v-model="params.s" label="Buscar Producto" hide-details prepend-icon="mdi-magnify" single-line class="ml-4"></v-text-field>
                <v-spacer></v-spacer>
                <v-btn v-if="create" tile small color="primary" type="button" href="/dashboard/products/create">Agregar Producto</v-btn>
            </v-toolbar>
        </template>
        <template v-slot:item.featured_image="{item}">
            <v-avatar tile size="48"><img :src="item.featured_image"></v-avatar>
        </template>
        <template v-slot:item.price="{item}">
            <span v-if="item.variants.length < 2">US$ {{item.variants[0].price}}</span><span v-else>{{ range(item.variants) }}</span>
        </template>
        <template v-slot:item.amount="{item}">
            <span >{{sum(item.variants)}} disponibles</span>
        </template>
        <template v-slot:item.published_at="{item}">
            <span>{{created(item.published_at)}}</span>
        </template>
        <!--<template v-slot:item.actions="{item}">
            <v-tooltip top>
                <template v-slot:activator="{on}">
                    <v-btn text icon color="primary" v-on="on" type="button" @click=""><v-icon small>mdi-pencil</v-icon></v-btn>
                </template>
                <span>Editar {{item.name}}</span>
            </v-tooltip>
        </template>-->
    </v-data-table>
    <v-snackbar color="green" v-model="creation_success" :timeout="3000">Perfil creado correctamente.</v-snackbar>
</div>
</template>
<script>
import ProductService from '../../services/products';

export default {
    props: ['create'],
    data() {
        return {
            creation_success: false,
            items_per_page: 25,
            total_count: 0,
            page: 1,
            total_pages: 0,
            visible_pages: 5,
            items: [],
            loading_items: true,
            options: {},
            params: {page: 1, s: ''},
            headers: [
                {text: 'Imagen', align: 'left', sortable: false, value: 'featured_image'},
                {text: 'Nombre', align: 'left', sortable: false, value: 'name'},
                {text: 'Precio', align: 'left', sortable: false, value: 'price'},
                {text: 'Disponible', align: 'left', sortable: false, value: 'amount'},
                {text: 'Fecha de Publicación', align: 'left', sortable: false, value: 'published_at'},
                //{text: 'Acciones', sortable: false, value: 'actions'}
            ],
            ps: new ProductService()
        }
    },
    watch: {
        options: {
            handler() {
                this.getItems();
            },
            deep: true
        }
    },
    mounted() {
        this.getItems();
    },
    methods: {
        created(date) {
            return moment(date).format('DD/MM/YYYY');
        },
        sum(variants) {
            return _.sumBy(variants, (v) => {return v.amount});
        },
        range(variants) {
            var first = _.head(variants);
            var last = _.last(variants);

            return (first.price == last.price) ? `US$ ${first.price}` : `US$ ${first.price} - US$ ${last.price}`;
        },
        searchItems: _.throttle(function(event) {
            this.getItems();
        }, 1000),
        getItems() {
            this.loading_items = true;
            this.params.page = this.options.page;
            this.ps.getProducts(this.params)
                .then(data => {
                    this.items = data.items;
                    this.total_count = data.total_count;
                    this.total_pages = Math.ceil(this.total_count / this.items_per_page);
                })
                .catch()
                .finally(() => {
                    this.loading_items = false;
                });
        }
    }
}
</script>