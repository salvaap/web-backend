<template>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <v-card class="w-full">
            <v-card-text>
                <v-row>
                    <v-col cols="12">
                        <v-tabs vertical v-model="tab">
                            <v-tab>Detalles</v-tab>
                            <v-tab>Cuentas</v-tab>
                            <v-tab-item>
                                <div class="px-6 py-4">
                                    <v-row>
                                        <v-col cols="12">Contenido detalles</v-col>
                                    </v-row>
                                </div>
                            </v-tab-item>
                            <v-tab-item>
                                <div class="px-6 py-4">
                                    <v-row>
                                        <v-col cols="12">Contenido cuentas</v-col>
                                    </v-row>
                                </div>
                            </v-tab-item>
                        </v-tabs>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                tab: null,
            }
        }
    }
</script>