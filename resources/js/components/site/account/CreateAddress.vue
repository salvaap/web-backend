<template>
    <form class="w-full mb-10 pb-10 border-b" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
        <h3 class="mb-6">Agregar Direccion</h3>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3">
                <Input id="name" label="Nombre de dirección" placeholder="Ej. Casa u Oficina" v-model="form.name" :errors="form.errors.get('name')" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3">
                <Input id="address" label="Dirección" placeholder="Reparto/Residencial, nro. de casa..." v-model="form.address" :errors="form.errors.get('name')" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3">
                <Input id="additional_information" label="Información adicional (opcional)" placeholder="Color de casa, instrucciones adicionales..." v-model="form.additional_information" :errors="form.errors.get('additional_information')" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/3 px-3">
                <Select placeholder="Seleccione una ciudad" label="Ciudad" v-model.number="form.department_id" @change="departmentSelected" :loading="loading_departments" :options="departments" item-value="id" item-text="name" :errors="form.errors.get('department_id')" />
            </div>
            <div class="w-full md:w-1/3 px-3">
                <Select placeholder="Seleccione un municipio" label="Municipio" v-model.number="form.town_id" :loading="loading_towns" :options="towns" item-value="id" item-text="name" :errors="form.errors.get('town_id')" />
            </div>
            <div class="w-full md:w-1/3 px-3">
                <Input id="postal_code" label="Código postal" placeholder="Ej. 21030" v-model="form.postal_code" :errors="form.errors.get('postal_code')" />
            </div>
        </div>
        <div class="flex flex-wrap mt-4">
            <button :disabled="creating" type="submit" class="btn btn-block btn-primary">
                <span v-if="creating" class="block relative top-icon px-2">
                    <span class="icon spinner">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                <span v-else>Guardar Dirección</span>
            </button>
        </div>
    </form>
</template>

<script>
    import AccountService from '../../../services/account';

    export default {
        props: {},
        data() {
            return {
                loading_departments: false,
                loading_towns: false,
                creating: false,
                departments: [],
                towns: [],
                form: new Form({
                    name: null,
                    address: null,
                    additional_information: null,
                    postal_code: null,
                    department_id: null,
                    town_id: null
                })
            };
        },
        created() {
            this.getDepartments();
        },
        methods: {
            departmentSelected(val) {
                this.getTowns(val);
            },
            getDepartments() {
                this.loading_departments = true;
                AccountService.getDerpartments()
                    .then(data => {
                        this.departments = data.departments;
                    })
                    .catch(e => {})
                    .finally(() => this.loading_departments = false);
            },
            getTowns(department_id) {
                this.loading_towns = true;
                AccountService.getTowns({department_id: department_id})
                    .then(data => {
                        this.towns = data.towns;
                    })
                    .catch(e => {})
                    .finally(() => this.loading_towns = false);
            },
            handle() {
                this.creating = true;
                this.form.post(`/account/addresses`)
                    .then(data => {
                        this.$emit('created', data.address);
                        const notification = {
                            type: 'success',
                            message: 'La dirección fue creada correctamente.'
                        };
                        this.$store.dispatch('notification/add', notification);
                    })
                    .catch(e => {
                        const notification = {
                            type: 'error',
                            message: 'La dirección no fue creada. Ingresa o selecciona todos los campos requeridos.'
                        };
                        this.$store.dispatch('notification/add', notification);
                    })
                    .finally(() => this.creating = false);
            }
        }
    }
</script>