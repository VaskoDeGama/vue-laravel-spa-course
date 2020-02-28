export default {
    state: {
        lastSearch: {
            from: null,
            to: null
        },
        basket: {
            item: [],
        }
    },
    mutations: {
        setLastSearch(state, payload) {
            state.lastSearch = payload;
        },
        addToBasket(state, payload) {
            state.basket.item.push(payload);
        },
        removeFromBasket(state, payload) {
            state.basket.item.filter(item => item.bookable.id !== payload);
        }
    },
    actions: {
        setLastSearch(context, payload) {
            context.commit('setLastSearch', payload);
            localStorage.setItem('lastSearch', JSON.stringify(payload));
        },
        loadStoredState(context) {
            const lastSeacrh = localStorage.getItem('lastSearch');
            if (lastSeacrh) {
                context.commit('setLastSearch', JSON.parse(lastSeacrh));
            }
        }
    }
}