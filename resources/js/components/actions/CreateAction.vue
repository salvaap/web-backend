<template>
    <div class="mr-5">
        <v-btn tile small color="primary" type="button" @click.prevent="show_dialog=true;">Agregar Acción</v-btn>
        <v-dialog v-model="show_dialog" persistent fullscreen hide-overlay transition="dialog-bottom-transition">
                <v-card tile :loading="loading" :disabled="loading">
                    <v-toolbar dark color="primary">
                        <v-btn icon dark @click="show_dialog = false;"><v-icon>mdi-close</v-icon></v-btn>
                        <v-toolbar-title>Crear Acción</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <form class="block max-w-full pt-5" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
                            <v-row>
                                <v-col cols="6">
                                    <v-select filled v-model="form.parent_id" :items="parent_actions" item-text="title" item-value="id" label="Seleccionar una ruta padre" :error-messages="form.errors.get('parent_id')"></v-select>
                                </v-col>
                                <v-col cols="6">
                                    <v-text-field filled label="Titulo" type="text" id="title" name="title" v-model="form.title" :error-messages="form.errors.get('title')" required></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-textarea filled label="Descripción" id="description" name="description" v-model="form.description" :error-messages="form.errors.get('description')" required></v-textarea>
                                </v-col>
                                <v-col cols="6">
                                    <v-text-field filled label="Acción" type="text" id="action" name="action" v-model="form.action" :error-messages="form.errors.get('action')" required></v-text-field>
                                </v-col>
                                <v-col cols="6">
                                    <v-text-field filled label="Icono" type="text" id="icon" name="icon" v-model="form.icon" :error-messages="form.errors.get('icon')" required></v-text-field>
                                </v-col>
                                <v-col cols="6">
                                    <v-select filled v-model="form.application_id" :items="application_options" item-text="name" item-value="id" label="Seleccionar aplicación a la que pertenece la ruta" :error-messages="form.errors.get('application_id')"></v-select>
                                </v-col>
                                <v-col cols="6">
                                    <v-select filled v-model="form.location" :items="location_options" item-text="title" item-value="id" label="Seleccionar la ubicación de la ruta" :error-messages="form.errors.get('location')"></v-select>
                                </v-col>
                                <v-col cols="6">
                                    <v-text-field filled label="Orden" type="text" id="order" name="order" v-model="form.order" :error-messages="form.errors.get('order')" required></v-text-field>
                                </v-col>
                                <v-col cols="6">
                                    <v-switch label="¿Ruta visible en menús?" id="is_visible" name="is_visible" v-model="form.is_visible" :error-messages="form.errors.get('is_visible')" @change="visible_change" required></v-switch>
                                </v-col>
                                <v-col cols="6">
                                    <v-switch label="¿Ruta es componente?" id="is_component" name="is_component" v-model="form.is_component" :error-messages="form.errors.get('is_component')" :disabled="form.is_visible" required></v-switch>
                                </v-col>
                                <v-col cols="12">
                                    <v-btn color="default" text type="button" @click="show_dialog = false;">Cancelar</v-btn>
                                    <v-btn color="primary" tile type="submit" :disabled="loading">Guardar</v-btn>
                                </v-col>
                            </v-row>
                        </form>
                    </v-card-text>
                </v-card>
        </v-dialog>
    </div>
</template>
<script>
export default {
    props: ['o', 'a'],
    data() {
        return {
            parent_actions: [],
            application_options: [],
            location_options: [{id: 'toolbar', title: 'Toolbar'}, {id: 'sidebar', title: 'Sidebar'}],
            loading: false,
            show_dialog: false,
            form: new Form({
                parent_id: null,
                title: null,
                description: null,
                action: null,
                icon: null,
                application_id: null,
                location: null,
                order: null,
                is_visible: false,
                is_component: false
            })
        }
    },
    mounted() {
        this.parent_actions = this.o;
        this.application_options = this.a;
    },
    methods: {
        visible_change() {
            if(this.form.is_visible) {
                this.form.is_component = false;
            }
        },
        handle() {
            this.loading = true;
            this.form.post('/dashboard/actions')
                .then(data => {
                    this.show_dialog = false;
                    this.$emit('completed', data.food);
                })
                .catch(error => {
                    //this.is_error = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }
}
</script>