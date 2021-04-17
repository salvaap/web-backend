<template>
    <div class="item">
        <div v-if="loading" class="absolute top-0 bottom-0 right-0 left-0 flex items-center justify-center bg-transparent">
            <div class="loader"></div>
        </div>
        <div class="item__actions">
            <button @click.prevent="$refs.editModal.openModal" type="button" class="action mr-1 text-blue-600" title="Editar">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </span>
            </button>
            <button @click.prevent="remove()" type="button" class="action text-red-600" title="Eliminar">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
        </div>
        <span class="block font-bold">{{ a.name }}</span>
        <span class="block">{{ a.address }} {{ a.town.name }}.</span>
        <span class="block">{{ a.town.department.name }}, {{ a.town.department.country.name }}.</span>
        <Modal ref="editModal">
            <template v-slot:header>
                <h2 class="text-center text-2xl font-extrabold text-primary-500">Editar {{ a.name }}</h2>
            </template>
            <template v-slot:body>
                <edit-address :address="a" @updated="address_updated"></edit-address>
            </template>
        </Modal>
    </div>
</template>

<script>
    import EditAddress from './EditAddress';
    import AccountService from '../../../services/account';

    export default {
        components: {
            'edit-address': EditAddress
        },
        props: {
            address: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                loading: false,
                a: this.address
            };
        },
        methods: {
            remove() {
                this.loading = true;
                AccountService.deleteAddress(+this.a.id)
                    .then(data => {
                        this.$emit('deleted', this.a);
                        const notification = {
                            type: 'success',
                            message: 'La dirección fue eliminada correctamente.'
                        };
                        this.$store.dispatch('notification/add', notification);
                    })
                    .catch(e => {
                        const notification = {
                            type: 'error',
                            message: 'La dirección no fue eliminada. Ingresa o selecciona todos los campos requeridos.'
                        };
                        this.$store.dispatch('notification/add', notification);
                    })
                    .finally(() => this.loading = false);
            },
            address_updated(address) {
                this.a = address;
                this.$emit('updated', address);
                this.$refs.editModal.closeModal();
            }
        }
    }
</script>