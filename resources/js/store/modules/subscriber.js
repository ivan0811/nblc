import Api from '../../services/Api'

export default {
    state: {
        subscriber: []
    },
    getters: {
        getSubscriber(state) {
            return state.subscriber
        }
    },
    mutations: {
        setSubscriber(state, data) {
            state.subscriber = data
        }
    },
    actions: {
        async loadSubscriber({ commit }) {
            try {
                await Api().get('/subscriber')
                    .then(res => {                              
                        commit('setSubscriber', res.data)                    
                    })
            } catch (error) {
                console.error(error)
            }
        },
        async sendMail({ }, form) {
            return await Api().post('send-email', form)
        },
        async subscribe({ }, form) {
            return await Api().post('subscribe', form)
        }
    }
}