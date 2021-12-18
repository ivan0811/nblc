<template>    
<div>
    <v-footer :class="$route.name == 'Home' || isDetail ? 'landing-home' : ''" color="dark" padless>    
      <v-card color="transparent" elevation="0" width="max-content" class="mx-auto">                    
            <form @submit.prevent="subscribeHandler" v-if="$route.name == 'Home' || isDetail" class="subscribe-form mx-auto">          
                <div class="content" :class="isDetail ? 'content-detail' : ''">
                    <div v-if="$route.name == 'Home'" class="font-header5 text-center mx-auto">
                        Subscribe Now for Get More Information about us
                    </div>           
                    <div v-if="isDetail" class="font-header5 mx-auto text-center" style="margin-bottom: 2%">
                        Subscribe for the Newsletter
                    </div>                 
                    <div v-if="isDetail" class="font-content2 mx-auto text-center">
                        If you want relevant updates occasionally, subscribe for the private newsletter. Your email is never shared. 
                    </div>
                    <div class="input-group d-flex mx-auto flex-wrap">
                        <input v-model="form.email" type="text" class="font-placeholder" placeholder="Enter Your Email">
                        <button type="submit" class="font-button">Subscribe</button>
                    </div>                             
                </div>                      
            </form>
            <div class="container-80">
                <v-row>                
                <v-col cols="" lg="5" md="5" sm="12">
                    <router-link to="/">
                        <div class="main-logo"></div>          
                    </router-link>                    
                    <p class="font-content3 mx-auto" style="color: #D1DCE5">NBLC Summit is a forum event of official and unofficial members, which consist of Accountability report within one period, recruitment of official members of NBLC and establishment of new officers for the next period. </p>                    
                </v-col>
                <v-col cols="" lg="3" md="3" sm="12">
                    <div>
                        <div class="font-subheader2 light--text">
                            NBLC Links
                        </div>            
                        <div class="d-flex flex-column">
                            <router-link to="/" class="font-link3 light--text">Home</router-link>
                            <router-link to="/sponsorship" class="font-link3 light--text">Sponsorship</router-link>
                            <router-link to="/news" class="font-link3 light--text">News</router-link>
                            <router-link to="" @click.native="instagramHandler()" class="font-link3 light--text">Instagram</router-link>
                            <router-link to="" @click.native="linkedinHandler()" class="font-link3 light--text">LInkedIn</router-link>   
                        </div>                            
                    </div>
                </v-col>
                <v-col cols="" lg="4" md="3" sm="12">
                    <div class="font-subheader2 light--text">
                        Contact Us
                    </div>        
                    <div class="d-flex flex-column">
                        <p class="light--text font-content4">
                            <v-icon>
                                mdi-email
                            </v-icon>
                            the7thnblcsummit2021@gmail.com
                        </p>
                        <p class="light--text font-content4">
                            <v-icon>
                                mdi-cellphone
                            </v-icon>
                            +62 838 073 006 60
                        </p>
                        <p class="light--text font-content4">
                            <v-icon>
                                mdi-map-marker
                            </v-icon>                            
                            Gedung K Kampus Sekaran Kecamatan Gunung Pati, Kota Semarang, Jawa Tengah 50229                            
                        </p>
                    </div>
                </v-col>
                <v-col cols="12">
                    <p class="mx-auto font-copyright">&copy; 2021 NBLC Summit. All rights Reserved</p>
                </v-col>
            </v-row>            
            </div>                            
      </v-card>    
  </v-footer>  
  <dialog-message :message="message" :show="showDialog" @close="showDialog = false"/>
</div>    
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import DialogMessage from './subscribe/dialogMessage.vue'
export default {
    components: {
      'dialog-message' : DialogMessage
    },
    data: () => ({        
        form: {
            email : ''
        },
        showDialog: false,
        message: []
    }),
    methods: {
        ...mapActions(['subscribe', 'instagramHandler', 'linkedinHandler']),
        async subscribeHandler(){
            await this.subscribe(this.form)
            .then(() => {                
                this.message = {email: ['you have subscribed now, to see the latest info please see email']}
                this.showDialog = true
                this.form.email = ''
            }).catch(error => {                
                this.message = error.response.data.message
                this.showDialog = true
            })
        }
    },
    computed: {
        isDetail(){
            return this.$route.name == 'DetailNews' || this.$route.name == 'About'
        }
    }
}
</script>