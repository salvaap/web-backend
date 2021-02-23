<template>
    <div class="not-found_wrapper">
        <div class="flex flex-1 items-center justify-center">
            <div class="block max-w-lg">
                <h1 class="text-10xl text-accent-500 leading-none">404</h1>
                <p class="text-2xl text-primary-500 font-bold uppercase mb-8">Página no encontrada.</p>
                <router-link to="/" class="btn btn-primary">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </span>
                    <span>Ir a Inicio</span>
                </router-link>
            </div>
        </div>
        <div class="flex flex-1 items-center justify-center not-found-img">&nbsp;</div>
    </div>
</template>