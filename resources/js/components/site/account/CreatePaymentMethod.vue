<template>
    <form class="w-full mb-10 pb-10 border-b" @submit.prevent="handle" @keydown="form.errors.clear()" novalidate>
        <h3 class="mb-6">Agregar Método de Pago</h3>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full px-3">
                <Input id="credit_card" type="tel" placeholder="" label="Número de Tarjeta" v-model="form.credit_card" v-cardformat:formatCardNumber :errors="form.errors.get('credit_card')" />
            </div>
        </div>
        <!--<div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/2 px-3">
                <Select placeholder="Seleccione una ciudad" label="Ciudad" v-model.number="form.department_id" @change="departmentSelected" :loading="loading_departments" :options="departments" item-value="id" item-text="name" :errors="form.errors.get('department_id')" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <Select placeholder="Seleccione un municipio" label="Municipio" v-model.number="form.town_id" :loading="loading_towns" :options="towns" item-value="id" item-text="name" :errors="form.errors.get('town_id')" />
            </div>
        </div>-->
        <div class="flex flex-wrap mt-4">
            <button :disabled="creating" type="submit" class="btn btn-block btn-primary">
                <span v-if="creating" class="block relative top-icon px-2">
                    <span class="icon spinner">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                <span v-else>Guardar Método de Pago</span>
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                creating: false,
                form: new Form({
                    credit_card: null,
                    card_expiry: null,
                    cvc: null
                })
            };
        },
        methods: {
            handle() {
                //
            }
        }
    }
</script>