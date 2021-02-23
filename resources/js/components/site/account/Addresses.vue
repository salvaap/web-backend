<template>
    <div>
        <div v-if="loading" class="flex items-center justify-center">
            <div class="loader"></div>
        </div>
        <create-address v-if="!loading" @created="address_created"></create-address>
        <section v-if="!loading">
            <h3 class="mb-6">Direcciones</h3>
            <div v-if="addresses.length" class="grid grid-cols-3 gap-3 text-sm">
                <address-item v-for="address in addresses" :key="address.id" :address="address" @updated="address_updated" @deleted="address_deleted"></address-item>
            </div>
            <div v-else class="text-center">
                <span>No hay direcciones registradas.</span>
            </div>
        </section>
    </div>
</template>

<script>
    import AddressItem from './AddressItem';
    import CreateAddress from './CreateAddress';
    import AccountService from '../../../services/account';

    export default {
        components: {
            'create-address': CreateAddress,
            'address-item': AddressItem
        },
        data() {
            return {
                loading: false,
                addresses: []
            }
        },
        created() {
            this.getAddresses();
        },
        methods: {
            address_deleted(address) {
                let i = _.findIndex(this.addresses, ['id', address.id]);
                this.addresses.splice(i, 1);
            },
            address_updated(address) {
                let i = _.findIndex(this.addresses, ['id', address.id]);
                this.addresses[i] = address;
            },
            address_created(address) {
                this.addresses.push(address);
            },
            getAddresses() {
                AccountService.getAddresses()
                    .then(data => {
                        this.addresses = data.addresses;
                    })
                    .catch()
                    .finally(() => {
                        this.loading = false;
                    });
            }
        }
    }
</script>