<template>
    <div>
        <div class="flex flex-wrap items-center justify-between pt-6">
            <v-subheader>Cuentas</v-subheader>
            <create-account :merchant_id="merchant_id" :banks="banks" @completed="account_created"></create-account>
        </div>
        <v-row>
            <v-col v-for="(item, index) in items" :key="index" cols="12" sm="6" md="4" lg="3">
                <v-card tile>
                    <v-card-title>
                        <h5>{{ item.name }}</h5>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-list dense>
                        <v-list-item>
                            <v-list-item-content><strong>Banco:</strong></v-list-item-content>
                            <v-list-item-content class="align-end">{{ item.bank.name }}</v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content><strong>Titular:</strong></v-list-item-content>
                            <v-list-item-content class="align-end">{{ item.account_titular }}</v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content><strong>Número:</strong></v-list-item-content>
                            <v-list-item-content class="align-end">{{ item.account_number }}</v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
    export default {
        //props: ['accounts', 'banks'],
        props: {
            merchant_id: {
                type: Number,
                default: 0
            },
            accounts: {
                type: Array,
                default: function() {
                    return [];
                }
            },
            banks: {
                type: Array,
                default: function() {
                    return [];
                }
            }
        },
        data() {
            return {
                items: [],
            }
        },
        mounted() {
            this.items = this.accounts;
            console.log(this.items);
        },
        methods: {
            account_created(account) {
                this.items.push(account);
            }
        }
    }
</script>