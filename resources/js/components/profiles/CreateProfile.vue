<template>
    <div class="mr-5">
        <v-btn tile small color="primary" type="button" @click.prevent="show_dialog=true;">Agregar Perfil</v-btn>
        <v-dialog v-model="show_dialog" persistent fullscreen hide-overlay transition="dialog-bottom-transition">
                <v-card tile :loading="loading" :disabled="loading">
                    <v-toolbar dark color="primary">
                        <v-btn icon dark @click="show_dialog = false;"><v-icon>mdi-close</v-icon></v-btn>
                        <v-toolbar-title>Crear Perfil</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <form class="block max-w-full pt-5" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field filled label="Nombre del Perfil" type="text" id="name" name="name" v-model="form.name" :error-messages="form.errors.get('name')" required></v-text-field>
                                    <v-select filled
                                        v-model="form.actions_ids"
                                        :items="actions"
                                        :item-text="function(item) {return `${item.title} (${item.action})`}"
                                        item-value="id"
                                        label="Selecciona las Acciones"
                                        multiple
                                        chips
                                        hint="Acciones a las que tiene acceso el perfil"
                                        persistent-hint
                                        :error-messages="form.errors.get('actions_ids')"></v-select>
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
    props: ['a'],
    data() {
        return {
            actions: [],
            loading: false,
            show_dialog: false,
            form: new Form({
                name: null,
                actions_ids: []
            })
        }
    },
    mounted() {
        this.actions = this.a;
    },
    methods: {
        visible_change() {
            if(this.form.is_visible) {
                this.form.is_component = false;
            }
        },
        handle() {
            this.loading = true;
            this.form.post('/dashboard/profiles')
                .then(data => {
                    this.show_dialog = false;
                    this.$emit('completed', data.profile);
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