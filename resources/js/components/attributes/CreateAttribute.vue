<template>
    <div>
        <v-btn tile small class="mb-4" color="primary" @click.prevent="attribute_dialog = true" type="button">Agregar Atributo</v-btn>
        <v-dialog v-model="attribute_dialog" width="500">
            <form class="block max-w-full" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
                <v-card>
                    <v-card-title>Agregar Atributo</v-card-title>
                    <v-card-text>
                        <div class="pt-4">
                            <v-text-field filled dense label="Nombre del Atributo" type="text" id="name" name="name" v-model="form.name" :error-messages="form.errors.get('name')"></v-text-field>
                        </div>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="default" text type="button" @click="attribute_dialog = false;">Cancelar</v-btn>
                        <v-btn color="primary" tile type="submit" :disabled="loading" :loading="loading">Guardar</v-btn>
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
            attribute_dialog: false,
            form: new Form({
                name: null,
            })
        }
    },
    mounted() {
        //
    },
    methods: {
        handle() {
            this.loading = true;
            this.form.post('/dashboard/attributes')
                .then(data => {
                    this.attribute_dialog = false;
                    this.$emit('completed', data.attribute);
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