<template>
    <div class="pt-header">
        <div class="container mx-auto pt-20">
            <div class="flex flex-wrap mb-10">
                <section class="w-4/6 px-4">
                    <div class="mb-6 py-6 px-4 rounded shadow bg-white">
                        <header class="flex justify-between mb-4"><span class="text-xl text-primary-500">Dirección de Envío</span><router-link to="account" class="text-xs font-semibold text-accent-500 hover:text-accent-800">+ Agregar Dirección</router-link></header>
                        <section class="grid grid-cols-3 gap-3 text-sm">
                            <div class="bg-gray-100 rounded overflow-hidden border border-accent-500 p-4">
                                <span class="block font-bold">Casa</span>
                                <span class="block">Linda Visa Sur #A-56</span>
                                <span class="block">Managua, Nicaragua.</span>
                            </div>
                            <div class="bg-gray-100 rounded overflow-hidden p-4">
                                <span class="block font-bold">Oficina</span>
                                <span class="block">Invercasa módulo #C8, piso 3</span>
                                <span class="block">Managua, Nicaragua.</span>
                            </div>
                            <div class="bg-gray-100 rounded overflow-hidden p-4">
                                <span class="block font-bold">Otro</span>
                                <span class="block">Residencial Xochitlan #220, km. 10.5 carretera a Masaya.</span>
                                <span class="block">Managua, Nicaragua.</span>
                            </div>
                        </section>
                    </div>
                    <div class="mb-6 py-6 px-4 rounded shadow bg-white">
                        <header class="flex justify-between mb-4"><span class="text-xl text-primary-500">Teléfono de Contacto</span><router-link to="account" class="text-xs font-semibold text-accent-500 hover:text-accent-800">+ Agregar Teléfono</router-link></header>
                        <section class="grid grid-cols-3 gap-3 text-sm">
                            <div class="bg-gray-100 rounded overflow-hidden border border-accent-500 p-4">
                                <span class="block font-bold">Personal</span>
                                <span class="block">+505 8469 1685</span>
                            </div>
                            <div class="bg-gray-100 rounded overflow-hidden p-4">
                                <span class="block font-bold">Secundario</span>
                                <span class="block">+505 7965 9311</span>
                            </div>
                            <div class="bg-gray-100 rounded overflow-hidden p-4">
                                <span class="block font-bold">Trabajo</span>
                                <span class="block">+505 2685 3684</span>
                            </div>
                        </section>
                    </div>
                    <div class="mb-6 py-6 px-4 rounded shadow bg-white">
                        <header class="flex justify-between mb-4"><span class="text-xl text-primary-500">Método de Pago</span><router-link to="account" class="text-xs font-semibold text-accent-500 hover:text-accent-800">+ Agregar Método</router-link></header>
                        <section class="grid grid-cols-3 gap-3 text-sm mb-10">
                            <div class="bg-gray-300 rounded overflow-hidden border border-accent-500 p-4">
                                <span class="block font-bold mb-1">Tarjeta Crédito/Débito</span>
                                <span class="block text-xs text-gray-700">Número:</span>
                                <span class="block">**** **** **** 6598</span>
                                <span class="block">Juan Lopez Perez</span>
                            </div>
                            <div class="bg-gray-300 rounded overflow-hidden p-4">
                                <span class="block font-bold mb-1">PayPal</span>
                                <span class="block text-xs text-gray-700">Cuenta paypal:</span>
                                <span class="block">correo_con_paypal@gmail.com</span>
                                <span class="block">Juan Lopez Perez</span>
                            </div>
                            <div class="bg-gray-300 rounded overflow-hidden p-4">
                                <span class="block font-bold mb-1">Transferencia</span>
                                <span class="block text-xs text-gray-700">Detalles</span>
                                <span class="block">Detalles de banco y nro de cuenta</span>
                            </div>
                        </section>
                        <p class="text-sm">Al realizar la compra estas aceptando nuestros <a href="#">términos y condiciones</a></p>
                        <button class="btn btn-primary btn-block" @click="executeCheckout">Ejecutar Compra</button>
                    </div>
                </section>
                <aside class="w-2/6 px-4">
                    <span class="block text-md text-center font-semibold mb-4">Tu Orden</span>
                    <div class="flex flex-col pl-4 border-b text-sm">
                        <div class="flex items-start w-full mb-4">
                            <span class="font-bold">1</span>
                            <span class="mx-2">x</span>
                            <span class="mr-2 flex-grow">Pantalon prueba |  lorem ipsum dolor sit amet consectetur adipisicing elit</span>
                            <span class="ml-a">$20.00</span>
                        </div>
                        <div class="flex items-start w-full mb-4">
                            <span class="font-bold">3</span>
                            <span class="mx-2">x</span>
                            <span class="mr-2 flex-grow">Camiseta Prueba |  lorem ipsum</span>
                            <span class="ml-a">$45.00</span>
                        </div>
                    </div>
                    <div class="flex flex-col pl-4 pt-4 border-b text-sm">
                        <div class="flex items-start w-full mb-4">
                            <span class="mr-2 flex-grow">Sub Total</span>
                            <span class="ml-a">$65.00</span>
                        </div>
                        <div class="flex items-start w-full mb-4">
                            <span class="mr-2 flex-grow">Costo de Envío</span>
                            <span class="ml-a">$2.00</span>
                        </div>
                        <div class="flex items-start w-full mb-4">
                            <span class="mr-2 flex-grow">Impuesto</span>
                            <span class="ml-a">$10.50</span>
                        </div>
                        <div class="flex items-start w-full mb-4 font-bold">
                            <span class="mr-2 flex-grow">Total</span>
                            <span class="ml-a">$77.50</span>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Checkout',
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
        executeCheckout() {
            this.$router.push('/payment')
        }
    }
}
</script>
