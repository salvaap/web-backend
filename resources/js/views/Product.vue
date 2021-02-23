<template>
  <div class="pt-header">
    <header class="w-full mb-4 py-20 bg-gray-200">
      <div class="flex flex-wrap justify-between container mx-auto">
        <h1 class="m-0">Detalle de Producto</h1>
        <p v-if="loaded" class="m-0">
          <router-link to="/" class="inline-block pr-2">
            <span class="icon">
              <svg viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
              </svg>
            </span>
            <span>Inicio</span>
          </router-link>
          <span class="inline-block pr-2">/</span>
          <span class="">{{product.name}}</span>
        </p>
      </div>
    </header>
    <div class="container mx-auto pt-4">
      <div v-if="!loaded" class="flex mb-10 py-10">
        <div class="flex flex-1 items-center justify-center py-20">
            <div class="loader"></div>
        </div>
      </div>
      <div v-else class="mb-10 py-6 rounded shadow bg-white">
        <product-details :product="product"></product-details>
      </div>
      <!--<div class="flex flex-wrap mb-10 py-6 rounded shadow bg-white">
        <div class="w-2/5">
        </div>
        <div class="w-3/5">&nbsp;</div>
        <div class="w-full border-t border-gray-300 pb-5">
          <div class="pl-6 pr-10 py-5 mt-5">
            <h3 class="mb-8">Productos Relacionados</h3>
            <div class="grid grid-cols-6 gap-2">
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">C$ 10.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder-2.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">C$ 12.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">C$ 15.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder-2.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">C$ 9.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">C$ 17.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder-2.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">C$ 9.00</span></figcaption>
              </figure>
            </div>
          </div>
        </div>
        <div class="w-full border-t border-gray-300">
          <div class="pl-6 pr-10 py-5 mt-5">
            <ul style="list-style: none; padding-left: 0;" class="flex border-b">
              <li class="-mb-px mr-1">
                <a class="bg-gray-100 inline-block border-l border-t border-r rounded-t py-2 px-4 text-primary-700 font-semibold" href="#">Comentarios</a>
              </li>
              <li class="mr-1">
                <a class="bg-white inline-block py-2 px-4 text-primary-500 hover:text-blue-800 font-semibold" href="#">Información adicional</a>
              </li>
            </ul>
            <div class="border-b border-l border-r px-5 py-5 mb-5 bg-gray-100">
              <h3>3 Comentarios</h3>
              <article class="px-2 py-4 mb-5 border-b">
                <header>
                  <h4>Allan Smith</h4>
                </header>
                <div>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, repellat! Rem fugit error quae esse architecto aspernatur explicabo nostrum quia recusandae, dolore in at earum molestiae vel voluptatem delectus fuga!</p>
                </div>
              </article>
              <article class="px-2 py-4 mb-5 border-b">
                <header>
                  <h4>Jane Doe</h4>
                </header>
                <div>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, repellat! Rem fugit error quae esse architecto aspernatur explicabo nostrum quia recusandae, dolore in at earum molestiae vel voluptatem delectus fuga!</p>
                </div>
              </article>
              <article class="px-2 py-4 mb-5 border-b">
                <header>
                  <h4>John Doe</h4>
                </header>
                <div>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, repellat! Rem fugit error quae esse architecto aspernatur explicabo nostrum quia recusandae, dolore in at earum molestiae vel voluptatem delectus fuga!</p>
                </div>
              </article>
              <form class="w-full">
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">Comentario</label>
                    <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-comment" rows="6" placeholder="Escribe tu comentario..."></textarea>
                  </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">Nombre</label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Jane">
                    <p class="text-red-500 text-xs italic">El nombre es requerido.</p>
                  </div>
                  <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Correo electrónico</label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Doe">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>-->
    </div>
  </div>
</template>

<script>
import StoreService from '../services/store';
import ProductDetails from '../components/site/products/ProductDetails';

export default {
  name: 'Product',
  props: {
    id: {
      type: Number,
      required: true
    }
  },
  components: {
    'product-details': ProductDetails
  },
  data() {
    return {
      loaded: false,
      product: null,
      selected_variant: null,
      amount_to_add: 1
    }
  },
  mounted() {
    this.get_product(+this.id);
  },
  methods: {
    add_to_cart(variant, amount) {
      this.$parent.add_to_cart(variant, amount);
    },
    select_variant(variant) {
      this.selected_variant = variant;
    },
    get_product(id) {
      StoreService.getProduct(id)
        .then(data => {
          this.product = data.product;
          this.selected_variant = this.product.variants[0];
          this.loaded = this.product ? true : false;
        })
        .catch(error => {})
        .finally(() => {});
    }
  }
}
</script>