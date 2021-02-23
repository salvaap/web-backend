<template>
    <div class="pt-header">
        <header class="w-full mb-4 py-20 bg-gray-200">
            <div class="flex flex-wrap justify-between container mx-auto">
                <h1 class="m-0">Mi Perfil</h1>
                <p class="m-0">
                <router-link to="/" class="inline-block pr-2">
                    <span class="icon">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    </span>
                    <span>Inicio</span>
                </router-link>
                <span class="inline-block pr-2">/</span>
                <span class="">Mi Perfil</span></p>
            </div>
        </header>
        <div class="container mx-auto pt-4">
            <!-- aca irian los tabs -->
            <tabs class="mb-10">
                <tab title="Datos personales">
                    <personal-data></personal-data>
                </tab>
                <tab title="Direcciones">
                    <addresses></addresses>
                </tab>
                <tab title="Métodos de Pago">
                    <payment-methods></payment-methods>
                </tab>
                <tab title="Historial de Pedidos">
                    <p>Contenido historial de pedidos</p>
                </tab>
            </tabs>
        </div>
    </div>
</template>
<script>
import PersonalData from '../components/site/account/PersonalData';
import Addresses from '../components/site/account/Addresses';
import PaymentMethods from '../components/site/account/PaymentMethods';

export default {
    name: 'Account',
    components: {
        'personal-data': PersonalData,
        'addresses': Addresses,
        'payment-methods': PaymentMethods
    },
    data() {
        return {
            //
        }
    },
    mounted() {
        //
    },
    watch: {
        //
    },
    methods: {
        selectionChanged(option) {
            //
        }
    }
}
</script>