import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: null,
        algo: 5
    },
    mutations: {
        setUser(state, user) {
            state.user = user
            if(user) {
                axios.defaults.headers.common['Authorization'] = `bearer ${user.token}`
                
            } else {
                delete axios.defaults.headers.common['Authorization']
                
            }
        },
        setAlgo(state, algo) {
            state.algo = algo

        }
    }
})