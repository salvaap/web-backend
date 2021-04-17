@extends('layouts.admin')

@section('content')

<header class="relative z-40 bg-white shadow">
    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
        <h1 class="text-xl font-bold leading-tight text-gray-900">
            Demo Escritorio
        </h1>
    </div>
</header>
<main class="w-full">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-4 gap-4 mb-4">
            <v-card tile class="py-4">
                <v-list-item three-line>
                    <v-list-item-content>
                        <div class="mb-8">
                            <span class="block text-md font-bold pb-3">Ganancias Totales</span>
                            <span class="block text-xs text-gray-600">(Últimos 30 días)</span>
                        </div>
                        <v-list-item-title class="headline mb-2">
                            <span class="block font-medium">US$ 1,593.26</span>
                        </v-list-item-title>
                        <v-list-item-subtitle class="mb-4">
                            <span class="text-green-500 text-xs">Ganancias subieron</span>&nbsp;<span class="text-gray-600 text-xs">(30 días anteriores)</span>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-avatar circle size="50" color="primary">
                        <v-icon dark>mdi-currency-usd</v-icon>
                    </v-list-item-avatar>
                </v-list-item>
                <v-card-actions>
                    <v-btn text small color="secondary">Ver Detalles</v-btn>
                </v-card-actions>
            </v-card>
            <v-card tile class="py-4">
                <v-list-item three-line>
                    <v-list-item-content>
                        <div class="mb-8">
                            <span class="block text-md font-bold pb-3">Total de Ordenes</span>
                            <span class="block text-xs text-gray-600">(Últimos 30 días)</span>
                        </div>
                        <v-list-item-title class="headline mb-2">
                            <span class="block font-medium">56,237</span>
                        </v-list-item-title>
                        <v-list-item-subtitle class="mb-4">
                            <span class="text-red-500 text-xs">Ordenes bajaron</span>&nbsp;<span class="text-gray-600 text-xs">(30 días anteriores)</span>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-avatar circle size="50" color="secondary">
                        <v-icon dark>mdi-cart-outline</v-icon>
                    </v-list-item-avatar>
                </v-list-item>
                <v-card-actions>
                    <v-btn text small color="secondary">Ver Detalles</v-btn>
                </v-card-actions>
            </v-card>
            <v-card tile class="py-4">
                <v-list-item three-line>
                    <v-list-item-content>
                        <div class="mb-8">
                            <span class="block text-md font-bold pb-3">Nuevos Clientes</span>
                            <span class="block text-xs text-gray-600">(Últimos 30 días)</span>
                        </div>
                        <v-list-item-title class="headline mb-2">
                            <span class="block font-medium">862</span>
                        </v-list-item-title>
                        <v-list-item-subtitle class="mb-4">
                            <span class="text-green-500 text-xs">Clientes subieron</span>&nbsp;<span class="text-gray-600 text-xs">(30 días anteriores)</span>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-avatar circle size="50" color="accent">
                        <v-icon dark>mdi-account-circle-outline</v-icon>
                    </v-list-item-avatar>
                </v-list-item>
                <v-card-actions>
                    <v-btn text small color="secondary">Ver Detalles</v-btn>
                </v-card-actions>
            </v-card>
            <v-card tile class="py-4">
                <v-list-item three-line>
                    <v-list-item-content>
                        <div class="mb-8">
                            <span class="block text-md font-bold pb-3">Envios Totales</span>
                            <span class="block text-xs text-gray-600">(Últimos 30 días)</span>
                        </div>
                        <v-list-item-title class="headline mb-2">
                            <span class="block font-medium">2,800</span>
                        </v-list-item-title>
                        <v-list-item-subtitle class="mb-4">
                            <span class="text-green-500 text-xs">Envíos subieron</span>&nbsp;<span class="text-gray-600 text-xs">(30 días anteriores)</span>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-avatar circle size="50" color="blue">
                        <v-icon dark>mdi-truck-fast-outline</v-icon>
                    </v-list-item-avatar>
                </v-list-item>
                <v-card-actions>
                    <v-btn text small color="secondary">Ver Detalles</v-btn>
                </v-card-actions>
            </v-card>
        </div>
        <div class="grid grid-cols-4 gap-4 mb-4">
            <v-card tile class="col-span-3">
                <v-card-title class="text-base">Historial de Ventas</v-card-title>
                <v-card-text>
                    <sales-history></sales-history>
                </v-card-text>
            </v-card>
            <v-card tile class="col-span-1">
                <v-card-title class="text-base">Compras por Plataforma</v-card-title>
                <v-card-text>
                    <sales-application></sales-application>
                </v-card-text>
            </v-card>
        </div>
    </div>
</main>

@endsection