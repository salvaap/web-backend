<template>
<div class="block">
    <v-data-table :page.sync="page" :headers="headers" :items="items" :items-per-page="items_per_page" :options.sync="options" :server-items-length="total_count" :loading="loading_items" hide-default-footer class="elevation-1">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Atributos</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-text-field @keydown="searchItems" v-model="params.s" label="Buscar Acción" hide-details prepend-icon="mdi-magnify" single-line class="ml-4"></v-text-field>
                <v-spacer></v-spacer>
                <create-attribute @completed="creation_success = true; getItems();"></create-attribute>
            </v-toolbar>
        </template>
        <template v-slot:item.parent="{item}">
            {{item.parent ? item.parent.title : '--'}}
        </template>
        <template v-slot:item.actions="{item}">
            <v-tooltip top>
                <template v-slot:activator="{on}">
                    <v-btn text icon color="primary" v-on="on" type="button" :href="`/dashboard/attributes/${item.id}/values`"><v-icon small>mdi-eye</v-icon></v-btn>
                </template>
                <span>Editar {{item.title}}</span>
            </v-tooltip>
        </template>
    </v-data-table>
    <v-snackbar color="green" v-model="creation_success" :timeout="3000">Atributo creado correctamente.</v-snackbar>
</div>
</template>
<script>
import AttributeService from '../../services/attributes';

export default {
    props: [],
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
                {text: 'Nombre', align: 'left', sortable: false, value: 'name'},
                {text: 'Acciones', sortable: false, value: 'actions'}
            ],
            as: new AttributeService()
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
        searchItems: _.throttle(function(event) {
            this.getItems();
        }, 1000),
        getItems() {
            this.loading_items = true;
            this.params.page = this.options.page;
            this.as.getAttributes(this.params)
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