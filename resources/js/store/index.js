import Vue from 'vue'
import Vuex from 'vuex'
import Auth from './modules/auth'
import Sponsor from './modules/sponsor'
import Subscriber from './modules/subscriber'
import Users from './modules/user'
import News from './modules/news'
import About from './modules/about'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        page: {
            unauth: [
                {
                    title: '',
                    name: 'home'
                },
                {
                    title: 'News',
                    name: 'news'
                },
                {
                    title: 'Sponsorship',
                    name: 'sponsorship'
                },
                {
                    title: '',
                    name: 'detailnews'
                },
                {
                    title: '',
                    name: 'learnmore'
                },
                {
                    title: '',
                    name: 'about'
                }
            ],
            auth: [
                {
                    title: 'Profile',
                    name: 'profile'
                },
                {
                    title: 'Dashboard',
                    name : 'dashboard'
                },
                {
                    title: 'Email Blast',
                    name: 'emailblast'
                },
                {
                    title: 'Manage News',
                    name: 'managenews'
                },
                {
                    title: 'Sponsor',
                    name: 'sponsor'
                },
                {
                    title: 'Manage About',
                    name: 'manageabout'
                },
                {
                    title: 'Subscriber',
                    name: 'subscriber'
                },
                {
                    title: 'User',
                    name: 'user'
                }                
            ]
        },
        eventSubscribe : false
    },
    getters: {        
        getPage(state) {
            return state.page
        },
        getEventSubscribe(state) {
            return state.eventSubscribe
        }
    },
    mutations: {
        setEventSubscribe(state, event) {
            state.eventSubscribe = event
        }        
    },
    actions: {
        setEventSubscribe({ commit }, event) {
            commit('setEventSubscribe', event)
        },
        instagramHandler() {
            window.open('https://www.instagram.com/nblcsummit', '_blank')
        },
        linkedinHandler() {
            window.open('https://www.linkedin.com/company/nblcindonesia', '_blank')
        }
    },
    modules: {
        Auth,
        Sponsor,
        Subscriber,
        Users,
        News,
        About
    }
})