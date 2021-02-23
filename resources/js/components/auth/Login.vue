<template>
    <div>
        <v-card tile class="col-span-3">
            <v-card-title class="text-center">Iniciar Sesión</v-card-title>
            <v-card-text>
                <form class="block" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
                    <v-text-field label="Correo Electrónico" id="email" name="email" type="email" v-model="form.email" :error-messages="form.errors.get('email')" required></v-text-field>
                    <v-text-field label="Contraseña" id="password" name="password" type="password" v-model="form.password" :error-messages="form.errors.get('password')" required></v-text-field>
                    <br>
                    <v-btn tile :loading="loading" color="primary" type="submit">Iniciar Sesión</v-btn>
                </form>
            </v-card-text>
        </v-card>
        <v-snackbar color="green" v-model="is_completed" :timeout="1800">Has iniciado sesión, el sistema de redirigirá en breve.</v-snackbar>
    </div>
</template>
<script>
export default {
    props: [],
    data() {
        return {
            loading: false,
            is_completed: false,
            form: new Form({
                email: null,
                password: null,
            })
        }
    },
    mounted() {
    },
    methods: {
        handle() {
            this.loading = true;
            this.form.post('/login')
                .then(data => {
                    //this.$emit('completed', data.food);
                    this.is_completed = true;
                    setTimeout(() => {
                        window.location.replace('/redirect');
                    }, 2000);
                })
                .catch(error => {
                    //this.is_error = true;
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }
}
</script>