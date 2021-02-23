<template>
    <form id="login-form" @submit.prevent="handle">
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input v-model="form.email" type="email" name="email" id="email">
            <p v-if="form.errors.has('email')" class="text-red-700 text-sm">{{ form.errors.get('email') }}</p>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input v-model="form.password" type="password" name="password" id="password">
            <p v-if="form.errors.has('password')" class="text-red-700 text-sm">{{ form.errors.get('password') }}</p>
        </div>
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <input v-model="form.remember" id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-900">Recordarme</label>
            </div>
            <div class="text-sm">
                <a href="#" class="font-medium text-secondary-600 hover:text-secondary-500">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
        <div class="py-4">
            <button :disabled="loading" type="submit" class="btn btn-primary btn-block">Ingresar</button>
        </div>
    </form>
</template>
<script>
    export default {
        data() {
            return {
                loading: false,
                form: new Form({
                    email: null,
                    password: null,
                    remember: false,
                })
            };
        },
        methods: {
            handle() {
                this.loading = true;
                axios.get('/sanctum/csrf-cookie').then(response => {
                    this.form.post('/login')
                        .then(data => {
                            axios.get('/user').then(response => {
                                window.location.replace('/redirect');
                            }).catch(e => {
                                console.log(e);
                            });
                        })
                        .catch(e => {
                            console.log(e);
                        });
                }).catch(e => {
                    console.log(e);
                }).finally(() => {
                    //
                });
            }
        },
    }
</script>