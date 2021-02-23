<template>
    <div>
        <v-btn text small color="secondary" @click="show_dialog = true;"><v-icon left>mdi-plus</v-icon> Agregar Cuenta</v-btn>
        <v-dialog v-model="show_dialog" width="500">
            <form class="block max-w-full" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
                <v-card>
                    <v-card-title>Agregar Atributo</v-card-title>
                    <v-card-text>
                        <div class="pt-4">
                            <v-text-field class="mb-4" filled dense label="Nombre descriptivo de la cuenta" type="text" id="name" name="name" v-model="form.name" :error-messages="form.errors.get('name')"></v-text-field>
                            <v-textarea class="mb-4" filled dense label="Descripción de la cuenta" id="description" name="description" v-model="form.description" :error-messages="form.errors.get('description')"></v-textarea>
                            <v-select class="mb-4" :items="banks" item-value="id" item-text="name" v-model="form.bank_id" filled dense label="Elige un banco" :error-messages="form.errors.get('bank_id')"></v-select>
                            <v-text-field class="mb-4" filled dense label="Nombre completo del titular de la cuenta" type="text" id="account_titular" name="account_titular" v-model="form.account_titular" :error-messages="form.errors.get('account_titular')"></v-text-field>
                            <v-text-field class="mb-4" filled dense label="Número de la cuenta" type="text" id="account_number" name="account_number" v-model="form.account_number" :error-messages="form.errors.get('account_number')"></v-text-field>
                        </div>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="default" text type="button" @click="show_dialog = false;">Cancelar</v-btn>
                        <v-btn color="primary" tile type="submit" :disabled="loading" :loading="loading">Guardar</v-btn>
                    </v-card-actions>
                </v-card>
            </form>
        </v-dialog>
    </div>
</template>
<script>
    export default {
        props: ['banks', 'merchant_id'],
        data() {
            return {
                show_dialog: false,
                loading: false,
                form: new Form({
                    name: '',
                    description: '',
                    bank_id: '',
                    account_titular: '',
                    account_number: ''
                })
            }
        },
        mounted() {
            //
        },
        methods: {
            handle() {
                this.loading = true;
                this.form.post(`/dashboard/commerce/${this.merchant_id}/accounts`)
                    .then(data => {
                        console.log(data);
                        this.$emit('completed', data.account);
                    })
                    .catch(e => {
                        console.log(e);
                    }).finally(() => {
                        this.loading = false;
                        this.show_dialog = false;
                    });
            }
        }
    }
</script>