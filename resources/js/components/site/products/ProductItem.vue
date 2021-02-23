<template>
    <div class="col">
        <article class="card mb-4">
            <img :src="item.featured_image" :alt="item.name" class="card-image">
            <div class="card-content">
                <header class="card-title"><router-link :to="{name: 'product', params: {id: item.id}}">{{item.name}}</router-link></header>
                <h3>
                    <span v-if="item.is_variant">{{ range }}</span>
                    <span v-else>C$ {{item.variants[0].price | price}}</span>
                </h3>
            </div><!-- /.card-content -->
            <footer v-if="item.is_variant" class="card-footer">
                <!--<router-link :to="{name: 'product', params: {id: item.id}}" class="view-options" type="button">Opciones</router-link>-->
                <button class="view-options" type="button" @click.prevent="open_options(item.id)">Opciones</button>
            </footer><!-- /.card-footer -->
            <footer v-else class="card-footer">
                <button :disabled="adding_to_cart" class="add-cart" type="button" @click.prevent="add_to_cart(item.variants[0], 1)">
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
            </footer><!-- /.card-footer -->
        </article><!-- /.card.mb-4 -->
    </div><!-- /.col -->
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            adding_to_cart: false,
        };
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
            this.$store.dispatch('cart/add', item).then(() => {}).catch(() => {}).finally(() => {
                this.adding_to_cart = false;
            });
        },
        open_options(item) {
            this.$store.dispatch('product/open', +item);
        }
    },
    computed: {
        sum() {
            return _.sumBy(this.item.variants, (v) => {return v.amount});
        },
        range() {
            let first = _.head(this.item.variants);
            let last = _.last(this.item.variants);

            return (first.price == last.price) ? `C$ ${numeral(first.price).format('0,0[.]00')}` : `C$ ${numeral(first.price).format('0,0[.]00')} - C$ ${numeral(last.price).format('0,0[.]00')}`;
        }
    }
}
</script>

<style>

</style>