import Api from '../../services/Api'

export default {
    state: {
        about: [],
        detailAbout: []
    },
    getters: {
        getAbout(state) {
            return state.about
        },
        getDetailAbout(state) {
            return state.detailAbout
        }
    },
    mutations: {
        setAbout(state, data) {
            state.about = data
        },
        setDetailAbout(state, data) {
            state.detailAbout = data
        }
    },
    actions: {
        async loadAbout({ commit }) {
            await Api().get('about')
                .then((res) => {
                    commit('setAbout', res.data)
                }).catch((err) => {
                    console.error(err)
                })
        },
        async loadDetailAbout({ commit }, slug) {
            await Api().get(`about/${slug}`)
                .then((res) => {                    
                    commit('setDetailAbout', res.data[0])
                }).catch((err) => {
                    console.error(err)
                })
        },
        async patchAbout({ }, form) {
            return await Api().patch(`about/update/${form.id}`, form)                
        }
    }
}