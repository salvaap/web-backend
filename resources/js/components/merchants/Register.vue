<template>
    <div>
        <form class="block" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
            <v-stepper v-model="step" alt-labels>
                <v-stepper-header>
                    <v-stepper-step step="1">
                        Detalles personales
                    </v-stepper-step>
                    <v-divider></v-divider>
                    <v-stepper-step step="2">
                        Detalles de la Tienda
                    </v-stepper-step>
                </v-stepper-header>
                <v-stepper-items>
                    <v-stepper-content step="1">
                        <h3 class="mb-4">Ingresa tus detalles personales.</h3>
                        <v-img max-width="250" :src="form.avatar"></v-img>
                        <v-progress-linear v-if="uploading_avatar" :value="progress_avatar"></v-progress-linear>
                        <v-file-input :disabled="loading || uploading" class="mb-3" dense filled @change="avatar_change" accept="image/png, image/jpeg" placeholder="Sube una imagen para usar como avatar" prepend-icon="mdi-camera" label="Subir avatar" :error-messages="form.errors.get('avatar')"></v-file-input>
                        <v-text-field class="mb-3" filled label="Nombre" id="first_name" name="first_name" type="text" v-model="form.first_name" :error-messages="form.errors.get('first_name')" required></v-text-field>
                        <v-text-field class="mb-3" filled label="Apellido" id="last_name" name="last_name" type="text" v-model="form.last_name" :error-messages="form.errors.get('last_name')" required></v-text-field>
                        <v-text-field class="mb-3" filled label="Correo Electrónico" id="email" name="email" type="email" v-model="form.email" :error-messages="form.errors.get('email')" required></v-text-field>
                        <v-text-field class="mb-3" filled label="Contraseña" id="password" name="password" type="password" v-model="form.password" :error-messages="form.errors.get('password')" required></v-text-field>
                        <v-text-field class="mb-3" filled label="Confirmar contraseña" id="password_confirmation" name="password_confirmation" type="password" v-model="form.password_confirmation" :error-messages="form.errors.get('password_confirmation')" required></v-text-field>
                        <v-menu ref="menu" v-model="menu" :close-on-content-click="false" transition="scale-transition" offset-y min-width="290px">
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field class="mb-3" filled v-model="form.birthday" label="Fecha de Nacimiento" id="birthday" name="birthday" append-icon="mdi-calendar" readonly v-bind="attrs" v-on="on" :error-messages="form.errors.get('birthday')" :hint="'Has click en el campo para seleccionar año, mes y día.'" persistent-hint required></v-text-field>
                            </template>
                            <v-date-picker ref="picker" v-model="form.birthday" :max="min_date" min="1950-01-01" @change="save" no-title scrollable></v-date-picker>
                        </v-menu>
                        <v-text-field class="mb-3" filled label="Nro. Cédula/Nro. Pasaporte" id="id_number" name="id_number" type="text" v-model="form.id_number" :error-messages="form.errors.get('id_number')" required></v-text-field>
                        <v-img max-width="250" :src="form.id_file"></v-img>
                        <v-progress-linear v-if="uploading_id_file" :value="progress_id_file"></v-progress-linear>
                        <v-file-input :disabled="loading || uploading" class="mb-3" dense filled @change="id_file_change" accept="image/png, image/jpeg" placeholder="Sube un scan/foto de tu cédula/pasaporte" prepend-icon="mdi-camera" label="Subir cédula/pasaporte" :error-messages="form.errors.get('id_file')"></v-file-input>
                        <br>
                        <div class="flex justify-end">
                            <v-btn type="button" :disabled="loading || uploading" tile text color="secondary" @click="step = 2">Siguiente</v-btn>
                        </div>
                    </v-stepper-content>
                    <v-stepper-content step="2">
                        <h3 class="mb-4">Ingresa los detalles de la tienda.</h3>
                        <v-img max-width="250" :src="form.merchant_logo"></v-img>
                        <v-progress-linear v-if="uploading_merchant_logo" :value="progress_merchant_logo"></v-progress-linear>
                        <v-file-input :disabled="loading || uploading" class="mb-3" dense filled @change="merchant_logo_change" accept="image/png, image/jpeg" placeholder="Subir logo de la tienda" prepend-icon="mdi-camera" label="Subir logo" :error-messages="form.errors.get('merchant_logo')"></v-file-input>
                        <v-text-field class="mb-3" filled label="Nombre" id="merchant_name" name="merchant_name" type="text" v-model="form.merchant_name" :error-messages="form.errors.get('merchant_name')" required></v-text-field>
                        <v-text-field class="mb-3" filled label="Nombre" id="merchant_address" name="merchant_address" type="text" v-model="form.merchant_address" :error-messages="form.errors.get('merchant_address')" required></v-text-field>
                        <v-text-field class="mb-3" filled label="Nombre" id="merchant_phone" name="merchant_phone" type="text" v-model="form.merchant_phone" :error-messages="form.errors.get('merchant_phone')" required></v-text-field>
                        <br>
                        <div class="flex justify-between">
                            <v-btn type="button" :disabled="loading || uploading" tile text color="secondary" @click="step = 1">Atrás</v-btn>
                            <v-btn :loading="loading || uploading" :disabled="loading || uploading" type="submit" tile color="primary">Completar</v-btn>
                        </div>
                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>
        </form>
        <!--<v-dialog v-model="uploading" hide-overlay persistent width="300">
            <v-card color="primary" dark>
                <v-card-text>
                    Cargando...
                    <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
                </v-card-text>
            </v-card>
        </v-dialog>-->
        <v-snackbar color="green" v-model="is_completed" :timeout="1800">Tu registro se ha enviado, pronto nos pondremos en contacto para verificar tu información.</v-snackbar>
    </div>
</template>
<script>
export default {
    props: [],
    data() {
        return {
            menu: false,
            loading: false,
            is_completed: false,
            uploading: false,
            uploading_avatar: false,
            uploading_id_file: false,
            uploading_merchant_logo: false,
            progress_avatar: 0,
            progress_merchant_logo: 0,
            progress_id_file: 0,
            step: 1,
            form: new Form({
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                password_confirmation: '',
                birthday: '',
                id_number: '',
                id_file: '',
                avatar: '',
                merchant_name: '',
                merchant_address: '',
                merchant_logo: '',
                merchant_town_id: '',
                merchant_phone: '',
                terms_and_conditions: false,
                exception: '',
            })
        }
    },
    mounted() {
    },
    watch: {
        menu(val) {
            val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'));
        }
    },
    computed: {
        min_date() {
            return moment().subtract(18, 'years').format('YYYY-MM-DD');
        }
    },
    methods: {
        merchant_logo_change(file) {
            if(!file) {
                return;
            }
            var data = new FormData();
            data.append('merchant_logo', file);
            this.uploading_merchant_logo = true;
            this.uploading = true;
            axios.post(`/merchants/register/merchant-logo`, data, {headers: {'Content-Type': 'multipart/form-data'}, onUploadProgress: this.merchant_logo_upload_progress}).then(response => {
                this.form.merchant_logo = response.data.merchant_logo;
            }).catch(e => {
                this.form.errors.errors.merchant_logo = e.response.data.errors.merchant_logo;
            }).finally(() => {
                this.uploading_merchant_logo = false;
                this.uploading = false;
            });
        },
        merchant_logo_upload_progress(e) {
            this.progress_merchant_logo = (e.loaded * 100) / e.total;
        },
        id_file_change(file) {
            if(!file) {
                return;
            }
            var data = new FormData();
            data.append('id_file', file);
            this.uploading_id_file = true;
            this.uploading = true;
            axios.post(`/merchants/register/id`, data, {headers: {'Content-Type': 'multipart/form-data'}, onUploadProgress: this.id_file_upload_progress}).then(response => {
                this.form.id_file = response.data.id_file;
            }).catch(e => {
                this.form.errors.errors.id_file = e.response.data.errors.id_file;
            }).finally(() => {
                this.uploading_id_file = false;
                this.uploading = false;
            });
        },
        id_file_upload_progress(e) {
            this.progress_id_file = (e.loaded * 100) / e.total;
        },
        avatar_change(file) {
            if(!file) {
                return;
            }
            var data = new FormData();
            data.append('avatar', file);
            this.uploading_avatar = true;
            this.uploading = true;
            axios.post(`/merchants/register/avatar`, data, {headers: {'Content-Type': 'multipart/form-data'}, onUploadProgress: this.avatar_upload_progress}).then(response => {
                //this.form.avatar = response.data.avatar;
                console.log(response.data);
            }).catch(e => {
                this.form.errors.errors.avatar = e.response.data.errors.avatar;
            }).finally(() => {
                this.uploading_avatar = false;
                this.uploading = false;
            });
        },
        avatar_upload_progress(e) {
            this.progress_avatar = (e.loaded * 100) / e.total;
        },
        save(date) {
            this.$refs.menu.save(date)
        },
        handle() {
            this.loading = true;
            this.form.post('/merchants/store')
                .then(data => {
                    this.is_completed = true;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }
}
</script>