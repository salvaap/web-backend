<template>
    <div>
        <div v-if="loading" class="flex items-center justify-center">
            <div class="loader"></div>
        </div>
        <form v-if="!loading" class="w-full mb-10 pb-10 border-b" @submit.prevent="handleName" @keydown="nameForm.errors.clear()" novalidate>
            <h3 class="mb-6">Datos Personales</h3>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <Input id="first_name" label="Nombre" placeholder="Ingresa tu nombre" v-model="nameForm.first_name" :errors="nameForm.errors.get('first_name')" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <Input id="last_name" label="Apellido" placeholder="Ingresa tu apellido" v-model="nameForm.last_name" :errors="nameForm.errors.get('last_name')" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <DateSelect id="birthday" label="Fecha de Nacimiento" placeholder="Selecciona tu fecha de nacimiento" v-model="nameForm.birthday" :errors="nameForm.errors.get('birthday')" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <Input id="phone" type="tel" label="Teléfono" placeholder="Ingresa tu número de teléfono" v-model="nameForm.phone" v-mask="'####-####'" :errors="nameForm.errors.get('phone')" />
                </div>
            </div>
            <div class="flex flex-wrap mt-4">
                <button :disabled="updating_user" type="submit" class="btn btn-block btn-primary">
                    <span v-if="updating_user" class="block relative top-icon px-2">
                        <span class="icon spinner">
                            <svg viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                    <span v-else>Actualizar Datos</span>
                </button>
            </div>
        </form>
        <form v-if="!loading" class="w-full pb-10 " @submit.prevent="handlePassword" @keydown="passwordForm.errors.clear()" novalidate>
            <h3 class="mb-6">Actualizar Contraseña</h3>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <Input id="current_password" type="password" label="Contraseña Actual" placeholder="Ingresa la contraseña actual" v-model="passwordForm.current_password" :errors="passwordForm.errors.get('current_password')" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <Input id="password" type="password" label="Nueva Actual" placeholder="Ingresa la nueva contraseña" v-model="passwordForm.password" :errors="passwordForm.errors.get('password')" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <Input id="password_confirmation" type="password" label="confirmar Nueva Actual" placeholder="Confirma la nueva contraseña" v-model="passwordForm.password_confirmation" :errors="passwordForm.errors.get('password_confirmation')" />
                </div>
            </div>
            <div class="flex flex-wrap mt-4">
                <button :disabled="updating_password" type="submit" class="btn btn-block btn-primary">
                    <span v-if="updating_password" class="block relative top-icon px-2">
                        <span class="icon spinner">
                            <svg viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                    <span v-else>Actualizar Contraseña</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import AccountService from '../../../services/account';
    import { mapActions } from 'vuex';

    export default {
        props: {},
        data() {
            return {
                user: null,
                loading: false,
                updating_user: false,
                updating_password: false,
                nameForm: new Form({
                    first_name: null,
                    last_name: null,
                    birthday: null,
                    phone: null
                }),
                passwordForm: new Form({
                    current_password: null,
                    password: null,
                    password_confirmation: null
                })
            };
        },
        created() {
            this.getUser();
        },
        methods: {
            ...mapActions(['updateUserName']),
            getUser() {
                this.loading = true;
                AccountService.getUser()
                    .then(data => {
                        this.user = data.user;
                        this.nameForm.first_name = data.user.first_name;
                        this.nameForm.last_name = data.user.last_name;
                        this.nameForm.birthday = (data.user.birthday) ? new Date(moment(data.user.birthday).toDate()) : null;
                        this.nameForm.phone = data.user.phone;
                    })
                    .catch(e => {
                        const notification = {
                            type: 'error',
                            message: 'Hubo un error al cargar la información. Si el problema persiste contacte a soporte técnico.'
                        };
                        this.$store.dispatch('notification/add', notification);
                    }).finally(() => {
                        this.loading = false;
                    });
            },
            handleName() {
                this.updating_user = true;
                this.nameForm.put(`/account/${this.user.id}/personal-info`).then(data => {
                    this.updateUserName({first_name: data.user.first_name, last_name: data.user.last_name});
                    const notification = {
                        type: 'success',
                        message: 'Los datos personales fueron actualizados correctamente.'
                    };
                    this.$store.dispatch('notification/add', notification);
                }).catch(e => {
                    const notification = {
                        type: 'error',
                        message: 'No se pudieron actualizar los datos personales. Revisa los campos proporcionados.'
                    };
                    this.$store.dispatch('notification/add', notification);
                }).finally(() => {
                    this.updating_user = false;
                });
            },
            handlePassword() {
                this.updating_password = true;
                this.passwordForm.post(`/account/${this.user.id}/password`).then(data => {
                    const notification = {
                        type: 'success',
                        message: 'La contraseña fue actualizada correctamente.'
                    };
                    this.$store.dispatch('notification/add', notification);
                }).catch(e => {
                    const notification = {
                        type: 'error',
                        message: 'No se pudo actualizar la contraseña. Revisa los campos proporcionados.'
                    };
                    this.$store.dispatch('notification/add', notification);
                }).finally(() => {
                    this.updating_password = false;
                });
            }
        }
    }
</script>