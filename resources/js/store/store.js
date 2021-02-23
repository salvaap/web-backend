import cart from './modules/cart';
import product from './modules/product';
import notification from './modules/notification';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        cart,
        product,
        notification
    },
    state: {
        categories: [],
        selected_category: null,
        user: null,
    },
    mutations: {
        SET_CATEGORY(state, value) {
            state.selected_category = value;
        },
        SET_CATEGORIES(state, value) {
            state.categories = value;
        },
        SET_USER(state, value) {
            state.user = value;
        },
        UPDATE_USER_NAME(state, value) {
            state.user.first_name = value.first_name;
            state.user.last_name = value.last_name;
        }
    },
    actions: {
        setCategories({ commit }, value) {
            if(value.length > 0) {
                commit('SET_CATEGORIES', value);
            }
        },
        selectCategory({ state, commit, getters }, value) {
            if(state.selected_category && state.selected_category.id === value) {
                commit('SET_CATEGORY', null);
            } else {
                let category = getters.getCategoryById(value);
                if(category) {
                    commit('SET_CATEGORY', category);
                }
            }
        },
        setUser({ commit }, value) {
            if(value) {
                commit('SET_USER', value);
            }
        },
        updateUserName({ commit }, value) {
            commit('UPDATE_USER_NAME', value);
        }
    },
    getters: {
        catLength: state => {
            return state.categories.length;
        },
        getCategoryById: state => id => {
            return state.categories.find(category => category.id === id);
        },
        selectedCategory: state => {
            return state.selected_category;
        }
    },
});