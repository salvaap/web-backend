<template>
    <div>
        <div v-if="loading" class="flex items-center justify-center">
            <div class="loader"></div>
        </div>
        <create-payment-method v-if="!loading"></create-payment-method>
    </div>
</template>

<script>
    import CreatePaymentMethod from './CreatePaymentMethod';

    export default {
        components: {
            'create-payment-method': CreatePaymentMethod
        },
        data() {
            return {
                loading: false,
                payment_methods: []
            }
        }
    }
</script>