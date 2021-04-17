<template>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <v-card class="w-full">
            <v-card-text>
                <v-row>
                    <v-col cols="12">
                        <v-subheader>Detalles</v-subheader>
                        <edit-commerce :merchant="merchant"></edit-commerce>
                        <v-divider></v-divider>
                        <commerce-accounts :merchant_id="merchant.id" :accounts="merchant.accounts" :banks="banks"></commerce-accounts>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
    export default {
        props: ['merchant', 'banks'],
        data() {
            return {
                tab: null,
            }
        },
        mounted() {
            //
        }
    }
</script>