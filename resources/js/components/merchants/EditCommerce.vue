<template>
    <div class="mb-8">
        <form @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
            <v-img max-width="250" :src="form.logo"></v-img>
            <v-progress-linear v-if="uploading" :value="progress"></v-progress-linear>
            <v-file-input class="mb-2" dense filled @change="logo_change" accept="image/png, image/jpeg" placeholder="Subir logo" prepend-icon="mdi-camera" label="Logo" :error-messages="form.errors.get('logo')"></v-file-input>
            <v-text-field filled dense id="name" name="name" class="mb-2" label="Nombre" v-model="form.name" :error-messages="form.errors.get('name')"></v-text-field>
            <v-text-field filled dense id="address" name="address" class="mb-2" label="Dirección" v-model="form.address" :error-messages="form.errors.get('address')"></v-text-field>
            <v-btn tile :loading="loading" :disabled="loading" color="primary" type="submit">Actualizar</v-btn>
        </form>
        <v-dialog v-model="uploading" hide-overlay persistent width="300">
            <v-card color="primary" dark>
                <v-card-text>
                    Cargando...
                    <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-snackbar color="success" v-model="update_success" :timeout="1800">Los datos fueron actualizados correctamente.</v-snackbar>
    </div>
</template>
<script>
    export default {
        props: ['merchant'],
        data() {
            return {
                loading: false,
                update_success: false,
                uploading: false,
                progress: 0,
                form: new Form({
                    logo: '',
                    name: '',
                    address: '',
                })
            }
        },
        mounted() {
            this.form.logo = this.merchant.logo;
            this.form.name = this.merchant.name;
            this.form.address = this.merchant.address;
        },
        methods: {
            logo_change(file) {
                if(!file) {
                    return;
                }
                var data = new FormData();
                data.append('logo', file);
                this.uploading = true;
                axios.post(`/dashboard/commerce/${this.merchant.id}/logo`, data, {headers: {'Content-Type': 'multipart/form-data'}, onUploadProgress: this.upload_progress}).then(response => {
                    this.form.logo = response.data.logo;
                }).catch(e => {
                    this.form.errors.errors.logo = e.response.data.errors.logo;
                }).finally(() => {
                    this.uploading = false;
                });
            },
            upload_progress(e) {
                this.progress = (e.loaded * 100) / e.total;
            },
            handle() {
                this.loading = true;
                this.form.put(`/dashboard/commerce/${this.merchant.id}`)
                    .then(data => {
                        console.log(data);
                    })
                    .catch(e => {
                        console.log(e);
                    }).finally(() => {
                        this.loading = false;
                        this.update_success = true;
                    });
            }
        }
    }
</script>