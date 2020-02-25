export default {
    state: {
        lastSearch: {
            from: null,
            to: null
        }
    },
    mutations: {
        setLastSearch(state, payload) {
            state.lastSearch = payload;
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