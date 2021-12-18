<template>
    <v-app>        
        <Header @scrollToSubscribe="setScrollSubscribe" v-if="isUnauth"></Header>        
        <Navigation v-if="isAuth"></Navigation>
        <HeaderNav v-if="isAuth"></HeaderNav>              
         <v-main v-if="isAuth" app class="bg-admin mx-10 pt-5">
            <router-view></router-view>                                      
        </v-main>      
        <router-view :scrollToSubscribe="toScrollSubscribe" v-else></router-view>                                      
        <Footer v-if="isUnauth"></Footer>
    </v-app>
</template>
<script>
import Header from "../components/HeaderHome.vue"
import Footer from "../components/FooterHome.vue"
import Navigation from "../components/Navigation.vue"
import HeaderNav from "../components/HeaderNav.vue"
import { mapGetters, mapActions } from 'vuex'
export default {
    components: {
        Header,
        Footer,
        Navigation,
        HeaderNav
    },
    data : () => ({        
        auth: [],
        unauth: [],
        routeName: '',
        isAuth: false,
        isUnauth: false,
        toScrollSubscribe: ''
    }),
    async mounted() {                
        this.auth = this.getPage.auth.map(item => {
            return item.name
        })        

        this.unauth = this.getPage.unauth.map(item => {
            return item.name
        })
        
        this.routeName = this.$route.name.toLowerCase()        
        this.ISUNAUTH()
        this.ISAUTH()
        await this.LoadProfile()
    },
    methods: {        
        ...mapActions(['loadProfile', 'setLoadingProfile']),
        ISUNAUTH(){
            this.isUnauth = this.unauth.includes(this.routeName)
        },
        ISAUTH(){
            this.isAuth = this.auth.includes(this.routeName)
        },
        async LoadProfile(){
            if(this.isAuth){                
                this.setLoadingProfile(true)        
                await this.loadProfile()        
                this.setLoadingProfile(false)
            }            
        },
        setScrollSubscribe(data){            
            this.toScroll = data
            setTimeout(() => {
                this.toScrollSubscribe = ''
            }, 100)
        }        
    },
    computed: {
        ...mapGetters([
            'getPage',
            'getProfile'
        ])                
    },
    watch:{
        $route(to, from){            
            this.routeName = to.name.toLowerCase()                        
            this.ISUNAUTH()
            this.ISAUTH()
        }
    }
}
</script>
<style lang="scss">
@import '../../sass/app.scss'
</style>