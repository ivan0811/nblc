import axios from "axios"
import Api from "../../services/Api"

export default {
    state: {
        profile: {},
        loadingProfile: false
    },
    getters: {
        getProfile(state) {
            return state.profile
        },
        getLoadingProfile(state) {
            return state.loadingProfile
        }
    },
    mutations: {
        setProfile(state, profile) {
            state.profile = profile
        },
        setLoadingProfile(state, loading) {
            state.loadingProfile = loading
        }
    },    
    actions: {
        async login({ }, form) {
            let user = await axios.post('/api/login', form)
            console.log(user.status == 200)
            if (user.status == 200) {
                localStorage.setItem('token', user.data.token)                   
            }        
            return user
        },
        async loadProfile({ }) {                           
            await Api().get('/profile').then(res => {
                let data = res.data[0]                    
                localStorage.setItem('name', data.name)
                localStorage.setItem('email', data.email)
                localStorage.setItem('alternative_email', data.alternative_email)
            }).catch(err => {                
                localStorage.removeItem('name')
                localStorage.removeItem('email')
                localStorage.removeItem('alternative_email')
            })            
        },
        setProfile({ commit }, profile) {
            commit('setProfile', profile)            
        },
        setLoadingProfile({ commit }, loading) {
            commit('setLoadingProfile', loading)
        },
        async updateProfile({ }, form) {
            return await Api().patch('update-profile', form)                
        },
        async logout({ }) {
            return await Api().post('logout')                
        }
    }
}