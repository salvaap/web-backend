<template>
    <div class="overlay" :class="{'open' : open }">
        <a @click.prevent="close" class="cancel"></a>
        <div class="modal modal-product">
            <a @click.prevent="close" class="close">
                <span class="icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></span>
            </a>
            <section class="modal-content">
                <div v-if="loading" class="flex flex-1 items-center justify-center py-20">
                    <div class="loader"></div>
                </div>
                <div v-if="!loading && product">
                    <product-details :product="product"></product-details>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import ProductDetails from './ProductDetails';

    export default {
        components: {
            'product-details': ProductDetails
        },
        computed: {
            ...mapState('product', ['product', 'open', 'loading'])
        },
        methods: {
            close() {
                this.$store.dispatch('product/close');
            }
        }
    }
</script>
