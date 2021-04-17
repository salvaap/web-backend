<template>
  <div class="pt-header">
    <header class="w-full mb-4 py-20 bg-gray-200">
      <div class="flex flex-wrap justify-between container mx-auto">
        <h1 class="m-0">Detalle de Producto</h1>
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
          <span class="">Camiseta de Prueba</span></p>
      </div>
    </header>
    <div class="container mx-auto pt-4">
      <div class="flex flex-wrap mb-10 py-6 rounded shadow bg-white">
        <div class="w-2/5">
          <div class="flex flex-wrap">
            <figure class="px-6 mb-5">
              <img class="border-4" src="/images/products/product.jpg" alt="Producto">
            </figure>
            <div class="grid grid-cols-3 gap-2 px-6">
              <img class="border-2 hover:border-primary-500 cursor-pointer" src="/images/products/product.jpg" alt="Producto">
              <img class="border-2 hover:border-primary-500 cursor-pointer" src="/images/products/product.jpg" alt="Producto">
              <img class="border-2 hover:border-primary-500 cursor-pointer" src="/images/products/product.jpg" alt="Producto">
            </div>
          </div>
        </div>
        <div class="w-3/5">
          <section class="px-10">
            <article class="pb-5 mb-5">
              <header class="mb-4">
                <p class="block mb-1"><span class="inline-block py-1 px-4 bg-terciary-900 text-white rounded-full text-xs">Nahima Store</span></p>
                <h2 class="text-3xl">Camiseta de Prueba</h2>
                <span class="inline-block text-gray-700 mb-2">8 disponibles</span>
                <span class="text-2xl block my-2 text-accent-500">US$ 15.00</span>
              </header>
              <div class="mb-6 pb-6 border-b">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima eius dignissimos expedita molestiae corrupti pariatur quae sequi ipsam. Eos quisquam natus quibusdam cupiditate similique minus officia consequuntur beatae commodi ipsum?</p>
                <ul class="pl-4 mb-4">
                  <li>Detalle producto 1</li>
                  <li>Detalle producto 2</li>
                  <li>Detalle producto 3</li>
                </ul>
                <span class="block font-semibold text-sm">
                  <span class="icon">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                  </span>
                  <span>Producto con garantía de 12 meses</span>
                </span>
              </div>
              <div class="variations mb-6">
                <div class="flex flex-wrap mb-4 space-x-6">
                  <div class="flex-grow-0 mb-4">
                    <span class="block text-sm font-black mb-2">Color</span>
                    <span class="w-10 h-10 inline-block mr-4 bg-red-500 rounded-full cursor-pointer hover:shadow-outline">&nbsp;</span>
                    <span class="w-10 h-10 inline-block mr-4 bg-blue-500 rounded-full cursor-pointer hover:shadow-outline">&nbsp;</span>
                    <span class="w-10 h-10 inline-block mr-4 bg-green-500 rounded-full cursor-pointer hover:shadow-outline">&nbsp;</span>
                  </div>
                  <div class="flex-grow-0 mb-4">
                    <span class="block text-sm font-black mb-2">Talla</span>
                    <span class="inline-block w-10 h-10 leading-10 mr-4 bg-gray-300 px-4 text-xs rounded-full cursor-pointer hover:shadow-outline">S</span>
                    <span class="inline-block w-10 h-10 leading-10 mr-4 bg-gray-300 px-4 text-xs rounded-full cursor-pointer hover:shadow-outline">M</span>
                    <span class="inline-block w-10 h-10 leading-10 mr-4 bg-gray-300 px-4 text-xs rounded-full cursor-pointer hover:shadow-outline">L</span>
                  </div>
                </div>
                <div class="flex flex-wrap mb-4">
                  <div class="flex-grow-0 mr-6">
                    <span class="block text-sm font-black mb-2">Cantidad</span>
                    <input class="shadow appearance-none border py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="1" min="1" max="8" type="number">
                  </div>
                  <div class="flex flex-grow">
                    <button class="btn btn-accent btn-wide self-end" type="button"><strong>+</strong>&nbsp;Carrito</button>
                  </div>
                </div>
              </div>
              <footer class="flex py-4">
                <div class="flex-grow mt-6">
                  <span class="inline-block bg-gray-200 rounded px-4 py-1 text-sm font-semibold text-gray-800 mr-2 mb-2">etiqueta 1</span>
                  <span class="inline-block bg-gray-200 rounded px-4 py-1 text-sm font-semibold text-gray-800 mr-2 mb-2">etiqueta 2</span>
                </div>
              </footer>
            </article>
          </section>
        </div>
        <div class="w-full border-t border-gray-300 pb-5">
          <div class="pl-6 pr-10 py-5 mt-5">
            <h3 class="mb-8">Productos Relacionados</h3>
            <div class="grid grid-cols-6 gap-2">
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">US$ 10.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder-2.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">US$ 12.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">US$ 15.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder-2.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">US$ 9.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">US$ 17.00</span></figcaption>
              </figure>
              <figure class="border shadow hover:shadow-md">
                <img class="mb-2 cursor-pointer" src="/images/products/product-placeholder-2.jpg" alt="Producto">
                <figcaption class="px-2 py-2 text-sm"><h4 class="mb-2"><a href="#">Nombre de producto</a></h4><span class="block text-primary-500 mb-2 font-bold">US$ 9.00</span></figcaption>
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
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'About',
  data() {
    return {
      //
    }
  },
  methods: {
    //
  }
}
</script>