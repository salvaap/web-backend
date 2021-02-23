<template>
    <div>
        <div id="cart-button" class="bg-accent-500 p-2 rounded-l cursor-pointer shadow-md" @click.prevent="toggle">
            <span class="flex justify-left font-bold text-sm text-white text-center mb-2">
                <span class="cursor-pointer flex items-center mr-2" @click.prevent="toggle">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span>{{count}} artículos</span>
            </span>
            <span class="block p-1 font-bold text-sm text-center bg-white text-accent-500 rounded">C$ {{total | price}}</span>
        </div>
        <div id="cart-container" :class="{'open': is_open}">
            <div v-if="loading" class="cart-loader">
                <div class="loader"></div>
            </div>
            <div class="flex justify-between border-b p-4 mb-5">
                <span class="flex justify-left font-bold text-accent-500">
                    <span class="cursor-pointer flex items-center mr-2" @click.prevent="toggle">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span>{{count}} artículos</span>
                </span>
                <span class="text-sm text-gray-500 cursor-pointer flex items-center" @click.prevent="toggle">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
            <div class="pt-4 px-4 absolute w-full overflow-auto" style="top: 57px; bottom: 65px;">
                <article v-for="(item, index) in items" :key="index" class="flex flex-wrap content-center">
                    <figure class="w-1/5 pr-2 flex flex-wrap content-center">
                        <img :src="item.model.featured_image" :alt="item.name">
                    </figure>
                    <div class="w-3/5 pr-1 py-2 flex flex-wrap content-center">
                        <h4 class="block w-full mb-0">{{item.name}} <span class="text-gray-600 text-sm">({{item.qty}})</span></h4>
                        <span class="block w-full text-accent-500 font-bold">C${{item.price | price}}</span>
                        <a @click="remove(item.rowId)" class="block w-full text-primary-500 font-bold text-xs">Quitar</a>
                    </div>
                    <div class="w-1/5 flex flex-wrap content-center">
                        <span class="block text-black text-md font-bold">C$ {{item.subtotal | price}}</span>
                    </div>
                </article>
            </div>
            <router-link :to="{name: 'checkout'}" id="checkout-container" class="flex justify-between rounded-full bg-accent-500 p-1">
                <span class="inline-block text-sm font-bold pl-5 py-2 text-white">Comprar</span>
                <span class="inline-block text-sm font-bold px-2 py-2 bg-white text-accent-500 rounded-full">C$ {{total | price}}</span>
            </router-link>
        </div>
    </div>
</template>
<script>
import { mapState, mapGetters } from 'vuex';

export default {
    data() {
        return {
            is_open: false,
        }
    },
    computed: {
        ...mapGetters('cart', ['items', 'count', 'total']),
        ...mapState('cart', ['loading']),
    },
    watch: {},
    mounted() {
        //this.components = this.data;
    },
    methods: {
        show_values(values) {
            let v = _.map(values, (i) => { return i.name });
            return _.join(v, ', ');
        },
        toggle() {
            this.is_open = !this.is_open;
        },
        remove(id) {
            this.$store.dispatch('cart/remove', id).then(() => {}).catch(() => {}).finally();
        }
    }
}
</script>
