<template>
    <div class="detail-box">
        <div class="text-center mx-auto primary--text font-header0" style="width: 80%">{{detail.title}}</div>        
        <div class="mx-auto font-content2" style="width: max-content; margin-top: 2%">{{date}}</div>        
        <v-img :src="detail.image" width="100%" style="margin-top: 5%; margin-bottom: 2%"></v-img>        
        <div class="container-80 mx-auto" style="margin-bottom: 10%">
            <hr>
            <div class="d-flex social-share">
                <button @click="shareFacebook()" class="default-button font-button elevation-1">
                    <v-icon>
                        mdi-facebook
                    </v-icon>  
                </button>
                <button @click="shareTwitter()" class="default-button font-button elevation-1">
                    <v-icon>
                        mdi-twitter
                    </v-icon>
                </button>
                <button @click="shareWhatsapp()" class="default-button font-button elevation-1">
                    <v-icon>
                        mdi-whatsapp
                    </v-icon>
                </button>
            </div>            
            <div v-html="detail.content" class="font-content2" style="margin-top: 2%"></div>
            <div class="d-flex mx-auto social-share">
                <button @click="shareFacebook()" class="default-button d-flex font-button2 elevation-1">
                    <v-icon>
                        mdi-facebook
                    </v-icon>
                    &nbsp;           
                    <div class="non-responsive">
                        Share on Facebook
                    </div>                             
                </button>
                <button @click="shareTwitter()" class="default-button d-flex font-button2 elevation-1">
                    <v-icon>
                        mdi-twitter
                    </v-icon>
                    &nbsp;
                    <div class="non-responsive">
                        Share on Twitter
                    </div>                             
                </button>
                <button @click="shareWhatsapp()" class="default-button d-flex font-button2 elevation-1">
                    <v-icon>
                        mdi-whatsapp
                    </v-icon>
                    &nbsp;
                    <div class="non-responsive">
                        Share on Whatsapp
                    </div>                             
                </button>
            </div>  
            <hr>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    data: () => ({
        loading: true,
        detail: {},
        date: ''
    }),
    async mounted(){
        await this.loadDetail(this.$route.params.slug)        
        this.detail = this.getDetail[0]
        this.date = this.getDetail.date
        this.loading = false
    },
    methods: {
        ...mapActions([
            'loadDetail',            
        ]),
        shareTwitter(){
            window.open(`https://twitter.com/intent/tweet?url=${window.location.href}&text=${this.detail.title}`, '_blank')
        },
        shareFacebook(){
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${window.location.href}`, '_blank')
        },
        shareWhatsapp(){
            window.open(`https://api.whatsapp.com/send/?phone&text=${window.location.href}&app_absent=0`, '_blank')
        }
    },
    computed: {
        ...mapGetters([
            'getDetail'
        ])
    }
}
</script>