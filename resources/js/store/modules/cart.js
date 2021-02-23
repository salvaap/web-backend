import CartService from '../../services/carts';

export default {
    namespaced: true,
    state: {
        cart: null,
        loading: false,
    },
    mutations: {
        SET_CART(state, value) {
            state.cart = value;
        },
        SET_LOADING(state, value) {
            state.loading = value;
        }
    },
    actions: {
        get({commit}) {
            commit('SET_LOADING', true);
            return CartService.getCart().then(data => {
                commit('SET_CART', data.cart);
            }).catch(e => {
                //
            }).finally(() => {
                commit('SET_LOADING', false);
            });
        },
        add({commit, dispatch}, item) {
            commit('SET_LOADING', true);
            return CartService.addToCart(item).then(data => {
                commit('SET_CART', data.cart);
                const notification = {
                    type: 'success',
                    message: 'El producto se agrego al carrito de compra.'
                };
                dispatch('notification/add', notification, { root: true });
            }).catch(error => {
                const notification = {
                    type: 'error',
                    message: 'Hubo un error al agregar el producto. Si el problema persiste contacte a soporte técnico.'
                };
                dispatch('notification/add', notification, { root: true });
            }).finally(() => {
                commit('SET_LOADING', false);
            });
        },
        remove({commit, dispatch}, id) {
            commit('SET_LOADING', true);
            return CartService.removeFromCart(id).then(data => {
                commit('SET_CART', data.cart);
                const notification = {
                    type: 'success',
                    message: 'El producto se quitó del carrito de compra.'
                };
                dispatch('notification/add', notification, { root: true });
            }).catch(error => {
                const notification = {
                    type: 'error',
                    message: 'Hubo un error al quitar el producto. Si el problema persiste contacte a soporte técnico.'
                };
                dispatch('notification/add', notification, { root: true });
            }).finally(() => {
                commit('SET_LOADING', false);
            });
        }
    },
    getters: {
        items: state => {
            return _.values(state.cart);
        },
        count: state => {
            return _.size(state.cart);
        },
        total: state => {
            let total = 0;
            _.forOwn(state.cart, (item) => {
                total += +item.subtotal;
            });
            return total;
        }
    }
};