import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

Vue.use(VueRouter)
import Home from '../pages/Home.vue'
import Login from '../pages/Auth/Login.vue'
import Dashboard from '../pages/admin/Dashboard.vue'
import Sponsor from '../pages/admin/Sponsor.vue'
import Subscriber from '../pages/admin/Subscriber.vue'
import User from '../pages/admin/User.vue'
import ManageNews from '../pages/admin/News.vue'
import Profile from '../pages/Auth/Profile.vue'
import NotFound from '../pages/NotFound.vue'
import Sponsorship from '../pages/Sponsorship.vue'
import News from '../pages/News.vue'
import DetailNews from '../pages/DetailNews.vue'
import About from '../pages/About.vue'
import ManageAbout from '../pages/admin/About.vue'

const routes = [
    {
        name: 'Home',
        path: '/',
        component: Home
    },
    {
        name: 'Sponsorship',
        path: '/sponsorship',
        component: Sponsorship
    },
    {
        name: 'News',
        path: '/news',
        component: News
    },
    {
        name: 'DetailNews',
        path: '/news/:slug',
        component: DetailNews
    },
    {
        name: 'ManageAbout',
        path: '/manage-about',
        component: ManageAbout
    },
    {
        name: 'About',
        path: '/about/:slug',
        component: About
    },
    {
        name: 'Login',
        path: '/login',
        component: Login
    },
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard
    },    
    {
        name: 'ManageNews',
        path: '/manage-news',
        component: ManageNews
    },
    {
        name: 'Sponsor',
        path: '/sponsor',
        component: Sponsor
    },
    {
        name: 'Subscriber',
        path: '/subscriber',
        component: Subscriber
    },
    {
        name: 'User',
        path: '/user',
        component: User
    },
    {
        name: 'Profile',
        path: '/profile',
        component: Profile
    },    
    {
        name: 'NotFound',
        path: '/*',
        component: NotFound
    }    
]

const router = new VueRouter({
    mode: 'history',
    routes
})

router.beforeEach(async (to, from, next) => {
    const authPage = store.getters['getPage'].auth.map(item => item.name)
    const token = localStorage.getItem('token')    

    if (authPage.includes(to.name.toLowerCase()) && token == null) next({ name: 'NotFound' })
    else next()
})

export default router
