import Api from '../../services/Api'

export default {
    state: {
        user: []
    },
    getters: {
        getUser(state) {
            return state.user
        }
    },
    mutations: {
        setUser(state, data) {
            state.user = data
        }
    },
    actions: {
        async loadUser({ commit }) {            
            await Api().get('/user')
            .then(res => {
                commit('setUser', res.data)
            }).catch(err => {
                console.error(err)
            })            
        },           
        async storeUser({ }, form) {
            return await Api().post('user', form)                
        },
        async patchUser({ }, form) {            
            return await Api().patch('user/' + form.id, form)
        },
        async destroyUser({ }, id) {
            return await Api().delete('user/' + id)
        }
    }
}