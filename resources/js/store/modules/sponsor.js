import ApiForm from '../../services/ApiForm'
import Api from '../../services/Api'

export default {
    state: {
        sponsor: [],
        position: [],
        loadingSponsor: true
    },
    getters: {
        getSponsor(state) {
            return state.sponsor
        },
        getPosition(state) {
            return state.position
        },
        getLoadingSponsor(state) {
            return state.loadingSponsor
        }
    },
    mutations: {
        setSponsor(state, data) {
            state.sponsor = data
        },
        setPosition(state, data) {
            state.position = data
        },
        setLoadingSponsor(state, loading) {
            state.loadingSponsor = loading
        }
    },
    actions: {
        async loadSponsor({ commit }) {
            try {
                await Api().get('sponsor')
                    .then(res => {
                        commit('setSponsor', res.data)
                    })
            } catch (error) {
                console.error(error)
            }
        },
        async loadPosition({ commit }) {            
            await Api().get('sponsor/position')
                .then(res => {
                    commit('setPosition', res.data)
                }).catch(err => {
                    console.log(err)
                })
        },
        async storeSponsor({ }, form) {
            return await ApiForm().post('sponsor', form)                
        },
        async patchSponsor({ }, form) {            
            return await ApiForm().post('sponsor/' + form.get('id'), form)
        },
        async destroySponsor({ }, id) {
            return await Api().delete('sponsor/' + id)
        },
        setLoadingSponsor({ commit }, loading) {
            commit('setLoadingSponsor', loading)            
        }
    }
}