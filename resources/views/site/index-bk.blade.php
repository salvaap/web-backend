@extends('layouts.app')

@section('content')

<div id="hero">
    <div id="hero-search" v-observe-visibility="visibilityChanged">
        <h2>Busca y compra fácilmente</h2>
        <p>Productos artesanales nacionales listos para llegar hasta la puerta de tu casa</p>
        <form id="hero-search-box" class="" action="/">
            <input type="search" placeholder="Busca tus productos acá...">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </form>
    </div>
</div>
<section class="w-full py-8 px-4 bg-gray-200" v-observe-visibility="fixateSidebar">
      <h3 class="mb-10 mt-0 text-center text-3xl">Productos destacados</h3>
      <div class="grid grid-cols-4 gap-4">
        <article class="flex rounded bg-primary-500 overflow-hidden shadow-md">
          <figure class="w-2/5">
            <img class="w-full object-cover object-center" src="/images/products/product.jpg" alt="Product">
          </figure>
          <div class="flex flex-wrap items-stretch w-3/5 px-4 py-3">
            <h4 class="w-full flex mb-2 mt-2 text-white">Producto</h4>
            <p class="w-full flex text-white">Lorem ipsum dolor sit amet</p>
            <footer class="w-full flex self-end justify-between">
              <span class="text-white font-bold">US$ 15</span>
              <button class="btn btn-sm btn-white" type="button"><strong>+</strong>&nbsp;Carrito</button>
            </footer>
          </div>
        </article>
        <article class="flex rounded bg-primary-500 overflow-hidden shadow-md">
          <figure class="w-2/5">
            <img class="w-full object-cover object-center" src="/images/products/product.jpg" alt="Product">
          </figure>
          <div class="flex flex-wrap items-stretch w-3/5 px-4 py-3">
            <h4 class="w-full flex mb-2 mt-2 text-white">Producto</h4>
            <p class="w-full flex text-white">Lorem ipsum dolor sit amet</p>
            <footer class="w-full flex self-end justify-between">
              <span class="text-white font-bold">US$ 15</span>
              <button class="btn btn-sm btn-white" type="button"><strong>+</strong>&nbsp;Carrito</button>
            </footer>
          </div>
        </article>
        <article class="flex rounded bg-primary-500 overflow-hidden shadow-md">
          <figure class="w-2/5">
            <img class="w-full object-cover object-center" src="/images/products/product.jpg" alt="Product">
          </figure>
          <div class="flex flex-wrap items-stretch w-3/5 px-4 py-3">
            <h4 class="w-full flex mb-2 mt-2 text-white">Producto</h4>
            <p class="w-full flex text-white">Lorem ipsum dolor sit amet</p>
            <footer class="w-full flex self-end justify-between">
              <span class="text-white font-bold">US$ 15</span>
              <button class="btn btn-sm btn-white" type="button"><strong>+</strong>&nbsp;Carrito</button>
            </footer>
          </div>
        </article>
        <article class="flex rounded bg-primary-500 overflow-hidden shadow-md">
          <figure class="w-2/5">
            <img class="w-full object-cover object-center" src="/images/products/product.jpg" alt="Product">
          </figure>
          <div class="flex flex-wrap items-stretch w-3/5 px-4 py-3">
            <h4 class="w-full flex mb-2 mt-2 text-white">Producto</h4>
            <p class="w-full flex text-white">Lorem ipsum dolor sit amet</p>
            <footer class="w-full flex self-end justify-between">
              <span class="text-white font-bold">US$ 15</span>
              <button class="btn btn-sm btn-white" type="button"><strong>+</strong>&nbsp;Carrito</button>
            </footer>
          </div>
        </article>
      </div>
    </section>
    <!-- move to vue component -->
    <home-catalog :categories="{{json_encode($categories)}}"></home-catalog>
    <!-- end move to component -->
    <section style="z-index: 101;" class="flex justify-between relative w-full py-8 bg-gray-200 shadow-inner">
      <div class="container mx-auto grid grid-cols-4 gap-4">
        <div class="flex flex-wrap p-3 bg-white shadow">
          <div class="w-1/3 text-accent-900">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <div class="flex content-center flex-wrap w-2/3 pl-3">
            <span class="mb-0 font-bold text-xl leading-tight">Paga de manera segura</span>
          </div>
        </div>
        <div class="flex flex-wrap p-3 bg-white shadow">
          <div class="w-1/3 text-accent-900">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg>
          </div>
          <div class="flex content-center flex-wrap w-2/3 pl-3">
            <span class="mb-0 font-bold text-xl leading-tight">Estima tus costos de envío</span>
          </div>
        </div>
        <div class="flex flex-wrap p-3 bg-white shadow">
          <div class="w-1/3 text-accent-900">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <div class="flex content-center flex-wrap w-2/3 pl-3">
            <span class="mb-0 font-bold text-xl leading-tight">Rastrea tus compras</span>
          </div>
        </div>
        <div class="flex flex-wrap p-3 bg-white shadow">
          <div class="w-1/3 text-accent-900">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
            </svg>
          </div>
          <div class="flex content-center flex-wrap w-2/3 pl-3">
            <span class="mb-0 font-bold text-xl leading-tight">Apoyando lo local</span>
          </div>
        </div>
      </div>
    </section>
    <Cart></Cart>

@endsection