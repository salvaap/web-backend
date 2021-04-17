<template>
<div class="block">
    <v-data-table :page.sync="page" :headers="headers" :items="items" :items-per-page="items_per_page" :options.sync="options" :server-items-length="total_count" :loading="loading_items" hide-default-footer class="elevation-1">
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Usuarios</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-text-field @keydown="searchItems" v-model="params.s" label="Buscar Usuario" hide-details prepend-icon="mdi-magnify" single-line class="ml-4"></v-text-field>
                <v-spacer></v-spacer>
                <create-user :p="profiles" @completed="creation_success = true; getItems();"></create-user>
            </v-toolbar>
        </template>
        <template v-slot:item.name="{item}">
            {{item.first_name + ' ' + item.last_name}}
        </template>
        <template v-slot:item.profile="{item}">
            {{item.profile.name}}
        </template>
        <template v-slot:item.created_at="{item}">
            <span>{{created(item.created_at)}}</span>
        </template>
        <template v-slot:item.actions="{item}">
            <v-tooltip top>
                <template v-slot:activator="{on}">
                    <v-btn text icon color="primary" v-on="on" type="button" @click=""><v-icon small>mdi-pencil</v-icon></v-btn>
                </template>
                <span>Editar {{item.first_name + ' ' + item.last_name}}</span>
            </v-tooltip>
        </template>
    </v-data-table>
    <v-snackbar color="green" v-model="creation_success" :timeout="3000">Perfil creado correctamente.</v-snackbar>
</div>
</template>
<script>
import UserService from '../../services/user';

export default {
    props: ['profiles'],
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
                {text: 'Correo', align: 'left', sortable: false, value: 'email'},
                {text: 'Perfil', align: 'left', sortable: false, value: 'profile'},
                {text: 'Fecha de registro', align: 'left', sortable: false, value: 'created_at'},
                {text: 'Acciones', sortable: false, value: 'actions'}
            ],
            us: new UserService()
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
            return moment(date).format('DD-MM-YYYY');
        },
        searchItems: _.throttle(function(event) {
            this.getItems();
        }, 1000),
        getItems() {
            this.loading_items = true;
            this.params.page = this.options.page;
            this.us.getUsers(this.params)
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