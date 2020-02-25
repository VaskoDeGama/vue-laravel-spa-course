export default {
    state: {
        lastSearch:{
            from: null,
            to: null
        }
    },
    mutations: {
        setLastSearch(state, payload) {
            state.lastChance = payload;
        },

    }
}