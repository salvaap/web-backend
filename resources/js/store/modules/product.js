import StoreService from '../../services/store';

export default {
    namespaced: true,
    state: {
        product: null,
        loading: false,
        open: false,
    },
    mutations: {
        SET(state, value) {
            state.product = value;
        },
        LOADING(state, value) {
            state.loading = value;
        },
        OPEN(state, value) {
            state.open = value;
        }
    },
    actions: {
        get({commit}, value) {
            commit('LOADING', true);
            return StoreService.getProduct(value).then(data => {
                commit('SET', data.product);
                commit('OPEN', true);
            }).catch(e => {
                //
            }).finally(() => {
                commit('LOADING', false);
            });
        },
        open({commit, dispatch}, value) {
            commit('LOADING', true);
            commit('OPEN', true);
            return StoreService.getProduct(value).then(data => {
                commit('SET', data.product);
            }).catch((e) => {
                let notification = {
                    type: 'error',
                    message: 'Hubo un error al cargar los detalles del producto. Si el problema persiste contacte a soporte técnico.'
                };
                dispatch('notification/add', notification, { root: true });
            }).finally(() => {
                commit('LOADING', false);
            })
        },
        close({commit}) {
            commit('OPEN', false);
            commit('SET', null);
        }
    },
    getters: {
        //
    }
};