<template>
<div>
    <v-app-bar
      class="light--text nav-bar"
      fixed
      color="dark"
      elevate-on-scroll                                       
    >    
        <!-- <v-app-bar-nav-icon color="light"></v-app-bar-nav-icon> -->                
        <div @click="$router.push({name : 'Home'})" class="main-logo"></div>
        <div class="sponsor-header non-responsive">
            <div class="font-content">Supported By</div>
            <div class="d-flex" v-if="!loadingSponsor">
                <a :href="item.link" v-for="item in headerSponsor" :key="item.id" target="blank">
                    <v-img height="2.5vw" width="2.5vw" :src="item.image"></v-img>
                </a>                
            </div>
        </div>        
        <v-spacer></v-spacer>

        <router-link to="/sponsorship" class="font-link1 light--text custom-link non-responsive">Sponsorship</router-link>
        <router-link to="/news" class="font-link1 light--text custom-link non-responsive">News</router-link>
        <router-link to="" @click.native="instagramHandler()" class="font-link1 light--text custom-link non-responsive">Instagram</router-link>
        <router-link to="" @click.native="linkedinHandler()" class="font-link1 light--text custom-link non-responsive">LinkedIn</router-link>  

        <v-btn @click="subscribeClickHandler()" class="font-button subscribe-button secondary--text pa-7 non-responsive">Subscription</v-btn>      

        <v-btn @click="show = !show" icon class="responsive">
            <v-icon color="light"> mdi-menu </v-icon>
        </v-btn>      
         
        <!-- <v-btn icon>
            <v-icon color="light">mdi-magnify</v-icon>
        </v-btn>

        <v-btn icon>
            <v-icon color="light">mdi-heart</v-icon>
        </v-btn>

        <v-btn icon>
            <v-icon color="light">mdi-dots-vertical</v-icon>
        </v-btn>             -->        
    </v-app-bar>    
     <v-expand-transition class="responsive">
          <div v-show="show" class="expand-transition-custom">
            <div class="container">
                <v-list>                
                    <v-list-item v-for="(item, i) in responsiveLink" :key="i" @click="linkHandler(item.to)" >
                        <v-list-item-title class="light--text">
                            {{item.link}}
                        </v-list-item-title>
                    </v-list-item>                                    
                </v-list>
                <div class="mx-auto" style="width: max-content">
                    <v-btn @click="subscribeClickHandler()" class="font-button subscribe-button secondary--text pa-7">Subscription</v-btn>      
                </div>    
                <div class="sponsor-header responsive">
                    <div class="font-content2 light--text">Supported By</div>
                    <div class="d-flex flex-wrap" v-if="!loadingSponsor">
                        <a class="px-2 py-2 mx-auto" :href="item.link" v-for="item in headerSponsor" :key="item.id" target="blank">
                            <v-img height="100px" width="100px" :src="item.image"></v-img>
                        </a>                
                    </div>
                </div>                    
            </div>            
          </div>
        </v-expand-transition>
</div>    
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    data: () => ({
        show: false,
        sponsor: [],
        loadingSponsor: true,
        responsiveLink: [
            {
                to: 'sponsorship',
                link: 'Sponsorship'
            },
            {
                to: 'news',
                link: 'News'
            },
            {
                to : 'https://www.instagram.com/nblcsummit',
                link: 'Instagram'
            },
            {
                to : 'https://www.linkedin.com/company/nblcindonesia',
                link: 'Linkedin'
            }
        ]
    }),
    async mounted(){
        window.addEventListener("resize", () => {      
            if(window.innerWidth >= 960){
                this.show = false
            }      
        })
        await this.loadSponsor()
        this.sponsor = this.getSponsor[0]
        this.loadingSponsor = false        
        setTimeout(() => {
            this.setLoadingSponsor(false)        
        }, 100)        
    },
    methods: {
        ...mapActions(['setEventSubscribe', 'loadSponsor', 'setLoadingSponsor', 'instagramHandler', 'linkedinHandler']),
        subscribeClickHandler(){
            this.show = false
            if(this.$route.name !== 'Home'){
                this.$router.push({
                    name: 'Home'
                })
            }            
            this.setEventSubscribe(true)
        },
        linkHandler(url){                     
            if(/http|https/.test(url)){
                window.open(url, '_blank')
            }else if(/[a-z]/.test(url)){
                this.$router.push(url)            
            }            
            this.show = false
        }
    },
    computed: {
        ...mapGetters([
            'getSponsor'            
        ]),
        headerSponsor(){
            return this.sponsor.filter(item => item.position === 'header')
        }
    },
    watch: {
        show(data){
            document.getElementsByTagName('body')[0].style.overflowY = data ? 'hidden' : 'scroll'
        },
        $route(to, from){            
            this.show = false
        }
    }
}
</script>
<style>
    .custom-link:hover{
        border-bottom: 2px solid #B69D74;        
    }    
    div.expand-transition-custom{
        position: fixed;
        background-color: #1F2839;
        z-index: 2;
        margin-top: 73px;
        width: 100%;
        height: 100%;
        right: 0;
        left: 0;                     
    }

    div.expand-transition-custom div.v-list.v-sheet.theme--light{
    background-color: #1F2839;  
    }

    div.expand-transition-custom a.v-list-item.v-list-item--link.theme--light{
    color: #FFFFFF !important;
    background-color: transparent !important;  
    }

    div.expand-transition-custom a.v-list-item--link:before{
    background-color: transparent;
    }

    div.expand-transition-custom .container{
        width: 90%;
        margin-right: auto;
        margin-left: auto;
    }

    /* div.expand-transition-custom a.v-list-item.v-list-item--link.theme--light.v-list-item--active{
    background-color: #F2F2F2 !important;  
    color: #F94F46 !important;
    } */
</style>