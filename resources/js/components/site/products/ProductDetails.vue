<template>
    <div class="flex flex-wrap">
        <div class="w-2/5">
            <product-images :variant="selected_variant"></product-images>
        </div>
        <div class="w-3/5">
            <section class="">
                <article class="pb-5 mb-5">
                    <header class="mb-4">
                        <p class="block mb-1"><span class="inline-block py-1 px-4 bg-terciary-900 text-white rounded-full text-xs">{{product.merchant.name}}</span></p>
                        <h2 class="text-3xl">{{product.name}}</h2>
                        <span v-if="product.is_variant" class="inline-block text-gray-700 mb-2">{{selected_variant.amount}} disponibles</span><span v-else class="inline-block text-gray-700 mb-2">{{selected_variant.amount}} disponibles</span>
                        <span v-if="product.is_variant" class="text-2xl block my-2 text-accent-500">C$ {{selected_variant.price | price}}</span><span v-else class="text-2xl block my-2 text-accent-500">C$ {{selected_variant.price | price}}</span>
                        <span v-if="product.condition_id" class="text-sm block my-2 text-gray-700"><strong>Condición:</strong> {{product.condition.name}}</span>
                    </header>
                    <div class="mb-6 pb-6 border-b">
                        <div v-html="product.description"></div>
                    </div>
                </article>
                <div class="variations mb-6">
                    <div v-if="product.is_variant" class="flex flex-wrap mb-4 space-x-6">
                        <div class="flex-grow-0 mb-4">
                            <span class="block text-sm font-black mb-2">Variaciones</span>
                            <div v-for="(variant, index) in product.variants" :key="index" @click="select_variant(variant)" class="p-4 bg-gray-300 inline-block mr-4 mb-4 cursor-pointer border-2 border-gray-300 hover:border-primary-500" :class="{'border-primary-400' : (selected_variant.id === variant.id)}">
                                <span v-for="(value, j) in variant.values" :key="j" class="block"><strong>{{value.attribute.name}}</strong>:&nbsp;{{value.name}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-4">
                        <div class="flex-grow-0 mr-6">
                            <span class="block text-sm font-black mb-2">Cantidad</span>
                            <input class="shadow appearance-none border py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model.number="amount_to_add" min="1" :max="selected_variant.amount" type="number">
                        </div>
                        <div class="flex flex-grow">
                            <button :disabled="adding_to_cart" class="btn btn-accent btn-wide self-end" type="button" @click.prevent="add_to_cart(selected_variant, amount_to_add)">
                                <span v-if="adding_to_cart" class="block relative top-icon px-2">
                                    <span class="icon spinner">
                                        <svg viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                                <span v-else>
                                    <span class="icon">
                                        <svg viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <span>Carrito</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ProductDetails',
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selected_variant: null,
                amount_to_add: 1,
                adding_to_cart: false,
            };
        },
        created() {
            this.selected_variant = this.product.variants[0];
        },
        methods: {
            add_to_cart(variant, amount) {
                this.adding_to_cart = true;
                let item = {
                    id: variant.id,
                    name: variant.product.name,
                    amount: amount,
                    price: variant.price
                };
                this.$store.dispatch('cart/add', item).finally(() => {
                    this.adding_to_cart = false;
                });
            },
            select_variant(variant) {
                this.amount_to_add = 1;
                this.selected_variant = variant;
            }
        }
    }
</script>