<template>
<div class="block">
    <v-data-table :page.sync="page" :headers="headers" :items="items" :items-per-page="items_per_page" :options.sync="options" :server-items-length="total_count" :loading="loading_items" hide-default-footer class="elevation-1">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Aplicaciones</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-text-field @keydown="searchItems" v-model="params.s" label="Buscar Aplicación" hide-details prepend-icon="mdi-magnify" single-line class="ml-4"></v-text-field>
                <v-spacer></v-spacer>
                <create-application @completed="creation_success = true; getItems();"></create-application>
            </v-toolbar>
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
    <v-snackbar color="green" v-model="creation_success" :timeout="3000">Aplicación creada correctamente.</v-snackbar>
</div>
</template>
<script>
import ApplicationService from '../../services/application';

export default {
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
                //{text: 'Acciones', sortable: false, value: 'actions'}
            ],
            as: new ApplicationService()
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
            this.as.getApplications(this.params)
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