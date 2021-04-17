<template>
    <div class="mr-5">
        <v-btn tile small color="primary" type="button" @click.prevent="show_dialog=true;">Agregar Aplicación</v-btn>
        <v-dialog v-model="show_dialog" persistent max-width="400px">
            <form class="block overflow-y-hidden" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
                <v-card tile :loading="loading" :disabled="loading">
                    <v-card-title>Crear Aplicación</v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field filled label="Nombre de Aplicación" type="text" id="name" name="name" v-model="form.name" :error-messages="form.errors.get('name')" required></v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="default" text type="button" @click="show_dialog = false;">Cancelar</v-btn>
                        <v-btn color="primary" tile type="submit" :disabled="loading">Guardar</v-btn>
                    </v-card-actions>
                </v-card>
            </form>
        </v-dialog>
    </div>
</template>
<script>
export default {
    props: [],
    data() {
        return {
            loading: false,
            show_dialog: false,
            form: new Form({
                name: null,
            })
        }
    },
    mounted() {
    },
    methods: {
        showDialog() {
            this.show_dialog = true;
        },
        handle() {
            this.loading = true;
            this.form.post('/dashboard/applications')
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