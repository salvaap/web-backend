<template>
    <div class="block">
        <v-data-table :page.sync="page" :headers="headers" :items="items" :items-per-page="items_per_page" :options.sync="options" :server-items-length="total_count" :loading="loading_items" hide-default-footer class="elevation-1">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Comercios</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-text-field @keydown="searchItems" v-model="params.s" label="Buscar Comercio" hide-details prepend-icon="mdi-magnify" single-line class="ml-4"></v-text-field>
                </v-toolbar>
            </template>
            <template v-slot:item.logo="{item}">
                <v-avatar tile size="48"><img :src="item.logo"></v-avatar>
            </template>
            <template v-slot:item.owner="{item}">
                {{item.owner.first_name}} {{item.owner.last_name}}
            </template>
            <template v-slot:item.actions="{item}">
                <v-tooltip top>
                    <template v-slot:activator="{on}">
                        <v-btn text icon color="primary" v-on="on" type="button" @click="show_merchant(item)"><v-icon small>mdi-eye</v-icon></v-btn>
                    </template>
                    <span>Ver {{item.name}}</span>
                </v-tooltip>
                <v-tooltip top>
                    <template v-slot:activator="{on}">
                        <v-btn text icon color="error" v-on="on" type="button" @click="delete_merchant(item)"><v-icon small>mdi-delete</v-icon></v-btn>
                    </template>
                    <span>Eliminar {{item.name}}</span>
                </v-tooltip>
            </template>
        </v-data-table>
        <v-snackbar color="green" v-model="creation_success" :timeout="3000">Comercio creado correctamente.</v-snackbar>
        <v-snackbar color="green" v-model="edit_success" :timeout="3000">Comercio editado correctamente.</v-snackbar>
        <v-snackbar color="success" v-model="delete_success" :timeout="3000">Comercio eliminado correctamente.</v-snackbar>
        <v-snackbar color="error" v-model="delete_error" :timeout="3000">Hubo un error eliminando el comercio, intentelo más tarde. Si el problema persiste contacte a soporte.</v-snackbar>
        <v-dialog v-model="show_dialog" persistent width="500">
            <v-card v-if="selected_merchant">
                <v-card-title>{{selected_merchant.name}}</v-card-title>
                <v-card-text>
                    <v-img max-width="150" class="mx-auto" :src="selected_merchant.logo"></v-img>
                    <p><strong>Nombre: </strong>{{selected_merchant.name}}</p>
                    <p><strong>Dueño: </strong>{{selected_merchant.owner.first_name}} {{selected_merchant.owner.last_name}} ({{selected_merchant.owner.email}})</p>
                    <p><strong>Dirección: </strong>{{selected_merchant.address}}</p>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text tile @click="show_dialog = false;" type="button">Cerrar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="delete_dialog" persistent width="500">
            <v-card>
                <v-card-title>Eliminar Comercio</v-card-title>
                <v-card-text>
                    <p>Al eliminar el comercio deshabilitarás el usuario y todos sus productos registrados.</p>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text tile @click="delete_dialog = false;" type="button">Cancelar</v-btn>
                    <v-btn :loading="delete_loading" :disabled="delete_loading" color="primary" tile @click="confirm_delete" type="button">Eliminar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
import MerchantService from '../../services/merchant';

export default {
    props: [],
    data() {
        return {
            creation_success: false,
            edit_success: false,
            delete_success: false,
            delete_error: false,
            delete_dialog: false,
            delete_loading: false,
            show_dialog: false,
            items_per_page: 25,
            total_count: 0,
            page: 1,
            total_pages: 0,
            visible_pages: 5,
            items: [],
            loading_items: true,
            options: {},
            params: {page: 1, s: ''},
            selected_merchant: null,
            headers: [
                {text: 'Logo', align: 'left', sortable: false, value: 'logo'},
                {text: 'Nombre', align: 'left', sortable: false, value: 'name'},
                {text: 'Dueño', align: 'left', sortable: false, value: 'owner'},
                {text: 'Acciones', sortable: false, value: 'actions'}
            ],
            ms: new MerchantService()
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
        show_merchant(merchant) {
            this.selected_merchant = merchant;
            this.show_dialog = true;
        },
        delete_merchant(merchant) {
            this.selected_merchant = merchant;
            this.delete_dialog = true;
        },
        confirm_delete() {
            this.delete_loading = true;
            this.ms.removeMerchant(+this.selected_merchant.id).then(data => {
                let i = _.findKey(this.items, ['id', +this.selected_merchant.id]);
                this.items.splice(i, 1);
                this.selected_merchant = null;
                this.delete_success = true;
            }).catch(e => {
                this.delete_error = true;
            }).finally(() => {
                this.delete_loading = false;
                this.delete_dialog = false;
            });
        },
        created(date) {
            return moment(date).format('DD/MM/YYYY');
        },
        searchItems: _.throttle(function(event) {
            this.getItems();
        }, 1000),
        getItems() {
            this.loading_items = true;
            this.params.page = this.options.page;
            this.ms.getMerchants(this.params)
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