import ApiForm from '../../services/ApiForm'
import Api from '../../services/Api'

export default {
    state: {
        news: [],
        detail: ''
    },
    getters: {
        getNews(state) {
            return state.news
        },
        getDetail(state) {
            return state.detail
        }
    },
    mutations: {
        setNews(state, data) {
            state.news = data
        },
        setDetail(state, data) {
            state.detail = data
        }
    },
    actions: {        
        async loadNews({ commit }, data) {
            try {
                await Api().get(`news?page=${data.page}&public_show=${data.public}`)
                    .then(res => {
                        commit('setNews', res.data)                        
                    })
            } catch (error) {
                console.error(error)
            }
        },
        async loadDetail({ commit }, slug) {
            await Api().get(`news/${slug}`)
            .then((res) => {
                console.log(res.data)
                commit('setDetail', res.data)
            }).catch(err => {
                console.error(err)
            })
        },
        async storeNews({ }, form) {
            return await ApiForm().post('news', form)                
        },
        async patchNews({ }, form) {            
            return await ApiForm().post('news/' + form.get('id'), form)
        },
        async destroyNews({ }, id) {
            return await Api().delete('news/' + id)
        }
    }
}