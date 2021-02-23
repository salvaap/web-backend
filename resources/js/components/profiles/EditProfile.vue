<template>
    <div class="mr-5">
        <v-tooltip top>
            <template v-slot:activator="{on}">
                <v-btn text icon color="primary" v-on="on" type="button" @click.prevent="load_profile"><v-icon small>mdi-pencil</v-icon></v-btn>
            </template>
            <span>Editar {{name}}</span>
        </v-tooltip>
        <v-dialog v-model="preloading" persistent width="300">
            <v-card>
                <v-card-text class="text-center pt-3">
                    Cargando perfil...
                    <v-progress-linear indeterminate color="primary" class="mb-0"></v-progress-linear>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-dialog v-model="show_dialog" persistent fullscreen hide-overlay transition="dialog-bottom-transition">
                <v-card tile :loading="loading" :disabled="loading">
                    <v-toolbar dark color="primary">
                        <v-btn icon dark @click="show_dialog = false;"><v-icon>mdi-close</v-icon></v-btn>
                        <v-toolbar-title>Editar Perfil</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <form v-if="this.profile" class="block max-w-full pt-5" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
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
import ProfileService from '../../services/profile';

export default {
    props: ['a', 'id', 'name'],
    data() {
        return {
            profile: null,
            actions: [],
            loading: false,
            preloading: false,
            show_dialog: false,
            form: new Form({
                name: null,
                actions_ids: []
            }),
            ps: new ProfileService()
        }
    },
    mounted() {
        this.actions = this.a;
    },
    methods: {
        load_profile() {
            this.get_item(+this.id);
        },
        get_item(id) {
            this.preloading = true;
            this.ps.getProfile(id).then(data => {
                this.profile = data.profile;
                this.form.name = this.profile.name;
                this.form.actions_ids = this.profile.actions_ids;
                this.preloading = false;
                this.show_dialog = true;
            }).catch(e => {
                console.log(e);
            });
        },
        handle() {
            this.loading = true;
            this.form.put(`/dashboard/profiles/${this.profile.id}`)
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