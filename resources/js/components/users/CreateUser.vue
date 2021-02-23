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
                                    <v-text-field filled label="Nombre" id="first_name" name="first_name" v-model="form.first_name" type="text" :error-messages="form.errors.get('first_name')" required></v-text-field>
                                    <v-text-field filled label="Apellido" id="last_name" name="last_name" v-model="form.last_name" type="text" :error-messages="form.errors.get('last_name')" required></v-text-field>
                                    <v-text-field filled label="Correo Electrónico" id="email" name="email" v-model="form.email" type="email" :error-messages="form.errors.get('email')" required></v-text-field>
                                    <v-text-field filled label="Contraseña" id="password" name="password" type="password" v-model="form.password" :error-messages="form.errors.get('password')" required></v-text-field>
                                    <v-text-field filled label="Confirmar contraseña" id="password_confirmation" name="password_confirmation" v-model="form.password_confirmation" type="password" :error-messages="form.errors.get('password_confirmation')" required></v-text-field>
                                    <v-autocomplete filled v-model="form.profile_id" :items="profiles" item-text="name" item-value="id" label="Selecciona el perfil" :error-messages="form.errors.get('profile_id')" required></v-autocomplete>
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
    props: ['p'],
    data() {
        return {
            profiles: [],
            loading: false,
            show_dialog: false,
            form: new Form({
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                password_confirmation: null,
                profile_id: null,
            })
        }
    },
    mounted() {
        this.profiles = this.p;
    },
    methods: {
        visible_change() {
            if(this.form.is_visible) {
                this.form.is_component = false;
            }
        },
        handle() {
            this.loading = true;
            this.form.post('/dashboard/users')
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