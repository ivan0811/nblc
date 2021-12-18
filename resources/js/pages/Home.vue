<template>
    <div>                      
         <v-carousel :cycle="!subscribeFocus" interval="4000" hide-delimiter-background v-model="carousel">
            <v-carousel-item
            v-for="(item, i) in items"
            :key="i"                                                                                          
            >            
            <div :class="'image-carousel' + i">           
                <div id="subscribe" class="cover d-flex flex-column">
                    <div class="sponsor-carousel" v-if="i == 0">
                        <div class="font-content light--text">Supported By</div>
                        <div class="d-flex" v-if="!loadingSponsor">
                            <a :href="item.link" v-for="item in carouselSponsor" :key="item.id" target="blank">
                                <v-img :src="item.image"></v-img>
                            </a>                
                        </div>
                    </div>                    
                    <p class="font-subheader1 light--text">NATIONAL BUSINESS LAW COMMUNITY PRESENTS</p>
                    <div class="font-header1 light--text">{{item.title}}</div>
                    <p class="font-subheader2 light--text">{{item.subtitle}}</p>                    
                    <router-link :to="!loadingHeader ? `about/${about[i].path}` : ''" class="link-text2 light--text mb-auto">Learn More 
                    <v-icon color="light">
                        mdi-arrow-right
                    </v-icon></router-link>                        
                    <form action="" @submit.prevent="subscribeHandler" method="post" class="mt-auto">   
                        <div class="subscribe-form">
                             <div class="input-group d-flex">                            
                                <input v-model="form.email" :id="`input_subscribe${i}`" 
                                @focus="subscribeFocus = true"
                                @blur="subscribeFocus = false"
                                :ref="`inputSubscribe${i}`" class="font-placeholder light--text" type="text" placeholder="For More Information Enter Your Email">
                                <div class="non-responsive-6 input-button my-auto">
                                    <button class="font-button">Subscribe</button>
                                </div>                            
                            </div>
                        </div>                                                                            
                        <div class="input-button my-auto responsive-6">
                            <button class="font-button">Subscribe</button>
                        </div>                                                
                    </form>
                </div>                    
            </div>
            </v-carousel-item>
        </v-carousel>
        <div class="container sponsor-box">
            <div class="font-header3 text-center">Thanks to Sponsor</div>
            <div class="d-flex mx-auto" style="width: max-content; margin-top: 2%; margin-bottom: 2%" v-if="!loadingSponsor">
                <a :href="item.link" v-for="item in contentSponsor" :key="item.id" target="blank" style="margin-left 5%; margin-right: 5%">
                    <v-img :src="item.image"></v-img>
                </a>                
            </div>
        </div>                  
        <div class="about-box">
            <div class="container-60">
            <div class="font-header2 secondary--text text-center">About NBLC SUMMIT</div>
            <p class="font-subheader2 text-center mx-auto">
                NBLC Summit is a forum for official and non-official members, including NBLC annual reports, the recruitment of official NBLC members, and the establishment of new officials in the next stage. The NBLC Summit 2021 will be held at Universitas Negeri Semarang. 
            </p>
            <v-row class="mx-auto">
                <v-col cols="" lg="6" md="6" sm="12" xs="12"></v-col>
                <v-col cols="" lg="6" md="6" sm="12" xs="12">
                    <div class="font-header4">Muhammad Kunisyahputra Pasha</div>
                    <p class="font-subheader2">Executive Director NBLC Indonesia</p>
                    <p class="font-content">NBLC Indonesia merupakan ... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer feugiat neque metus, nec pellentesque eros auctor at. Aliquam nec arcu sed eros viverra elementum. </p>                
                </v-col>            
                <v-col cols="6" class="responsive"></v-col>
                <v-col cols="" lg="6" md="6" sm="12" xs="12">
                    <div class="font-header4">Farrel Rivishah Raashad</div>
                    <p class="font-subheader2">Project Officer NBLC Summit 2021</p>
                    <p class="font-content">NBLC Summit merupakan ... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer feugiat neque metus, nec pellentesque eros auctor at. Aliquam nec arcu sed eros viverra elementum.</p>
                </v-col>
                <v-col cols="6" class="non-responsive"></v-col>
            </v-row>
            </div>
        </div>             
        <!-- <div class="container">
            <div class="text-h3 text-center">The Event</div>
            <p class="subtitle-text text-center mx-auto" style="width: 620px">
                The 7th NBLC Summit events include national webinars, paper publishing competitions, and summits. Held in October and December
            </p>
            <v-row>
                <v-col>
                    <div class="img-event1"></div>
                    <p class="subtitle-text">We regularly update our blog to provide you with the latest information about our events.</p>
                    <router-link to="" class="secondary--text">Learn More </router-link>
                </v-col>
                <v-col>
                    <div class="img-event2"></div>
                    <p class="subtitle-text">We regularly update our blog to provide you with the latest information about our events.</p>
                    <router-link to="" class="secondary--text">Learn More </router-link>
                </v-col>
                <v-col>
                    <div class="img-event3"></div>
                    <p class="subtitle-text">We regularly update our blog to provide you with the latest information about our events.</p>
                    <router-link to="" class="secondary--text">Learn More </router-link>
                </v-col>                
            </v-row>
        </div> -->
        <div class="timeline-box">
            <div class="container-60">
                <div class="font-header2 secondary--text text-center">Timeline</div>
                <p class="font-subheader2 text-center mx-auto">
                    Here, Timeline Event of National Business Law Community Summit 2021
                </p>
                <v-row class="mx-auto">
                    <v-col lg="3" md="3" class="ml-auto non-responsive-6 pt-0">
                        <div class="ml-auto" style="width: max-content; margin-top: 1vw;" :style="'height: calc(' + (timeline1) +'px)'">
                            <p class="font-subheader2">17 October 2021</p>
                        </div>                   
                        <div class="ml-auto" style="width: max-content" :style="'height: calc(' + (timeline2) +'px)'">
                            <p class="font-subheader2">18 December 2021</p>
                        </div>                   
                        <div class="ml-auto" style="width: max-content">
                            <p class="font-subheader2">18 October 2021</p>
                        </div>                                                          
                    </v-col>
                    <v-col lg="2" md="2" sm="2" class="non-responsive-6">  
                        <div class="circle-list"></div>                        
                            <div id="vl_1" ref="vl1" class="vl" :style="'height: calc(' + (timeline1) +'px - 2vw)'"></div>
                            <div class="circle-list"></div>
                            <div id="vl_2" ref="vl2" class="vl" :style="'height: calc(' + (timeline2) +'px - 2vw)'"></div>
                        <div class="circle-list"></div>                                                                     
                    </v-col>                
                    <v-col lg="6" md="6" sm="6" xs="12">
                        <div class="d-flex">
                            <div class="responsive-6 mr-3" :style="'margin-top:calc('+timelineMarginTop+'px + 1%)'">
                                <div class="circle-list"></div>                        
                                    <div id="vl_1" ref="vl1" class="vl" :style="'height: calc(' + (timeline1) +'px + 33px)'"></div>
                                    <div class="circle-list"></div>
                                    <div id="vl_2" ref="vl2" class="vl" :style="'height: calc(' + (timeline2) +'px + 33px)'"></div>
                                <div class="circle-list"></div>
                            </div>                                                         
                            <div id="timelineContent" ref="timeline_content">
                                <p class="font-subheader2 responsive-6" id="timelineFirst" ref="timeline_first">17 October 2021</p>                        
                                <div class="timeline-content" id="timeline_1" ref="timeline1">
                                    <div class="font-header4 secondary--text">Webinar Pre Event</div>
                                    <p class="font-content">
                                        National Webinar The 7th NBLC Summit Come Up With The Theme  “Perubahan Iklim Investasi Atas Berlakunya UU No. 11 Tahun 2020 tentang Ciptakerja Terhadap Foreign Direct Investment di Tengah Percepatan Pertumbuhan Ekonomi Nasional” 
                                    </p>
                                </div>                        
                                <p class="font-subheader2 responsive-6">18 December 2021</p>
                                <div class="timeline-content"  id="timeline_2" ref="timeline2">
                                    <div class="font-header4 secondary--text">Paper Presentation Competition</div>
                                    <p class="font-content">
                                        Paper Presentation Competition is a competition to analyze cases that have been given from a legal point of view in writing in the form of a Paper of Research based on the applicable regulations in Indonesia. The purpose of this competition is to exchange ideas and test the acuity of case analysis
                                    </p>
                                </div>                        
                                <p class="font-subheader2 responsive-6">18 October 2021</p>
                                <div class="timeline-content"  id="timeline_3" ref="timeline3">
                                    <div class="font-header4 secondary--text">Business Law Community Summit</div>
                                    <p class="font-content">
                                        The NBLC Summit includes Accountability Report of Permanent Members; Organizational Advisory Board ("DPO" Determination Session); Selection of Executive Director and NBLC Organizational Structure; Recruitment of NBLC Permanent Members; as well as the Stipulation Session of the Articles of Association.
                                    </p>
                                </div>                        
                            </div>         
                        </div>                                                           
                    </v-col>
                </v-row>
            </div>
        </div>
        <div class="mx-auto speaker-box">
            <div class="container-60">
            <div class="font-header2 secondary--text text-center">Speakers</div>
            <p class="font-subheader2 text-center mx-auto">
                Therefore, we present you the speakers of Pre-Event The 7th National Business Law Community Summit 2021 as below :
            </p>
            <v-row>
                <v-col cols="" lg="6" md="6" sm="6" xs="12">      
                    <v-hover v-slot="{ hover }">
                        <v-card
                        class="mx-auto"
                        color="grey lighten-4"
                        max-width="70%"
                        elevation="0"
                        rounded="lg"
                        >                        
                        <v-img src="/img/speaker/speaker1.png">
                        <v-expand-transition>
                            <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out v-card--reveal text-h2 white--text"
                                style="height: 100%;"
                            >
                                <div class="social-media">
                                    <v-btn icon color="white">
                                        <v-icon>
                                            mdi-instagram
                                        </v-icon>
                                    </v-btn>
                                    <v-btn icon color="white">
                                        <v-icon>
                                            mdi-twitter
                                        </v-icon>
                                    </v-btn>
                                    <v-btn icon color="white">
                                        <v-icon>
                                            mdi-linkedin
                                        </v-icon>
                                    </v-btn>
                                </div>        
                            </div>
                            </v-expand-transition>
                        </v-img>                        
                        </v-card>
                    </v-hover>                                  
                    <div class="font-header4 mx-auto" style="width: max-content">Albertus Andhika, S.H.,MlntBus</div>
                    <p class="font-content2 text-center mx-auto" style="width: 80%">
                        Senior Associate at Mochtar Karuwin Komar Law Firm
                    </p>
                </v-col>
                <v-col cols="" lg="6" md="6" sm="6" xs="12">
                      <v-hover v-slot="{ hover }">
                        <v-card
                        class="mx-auto"
                        color="grey lighten-4"
                        max-width="70%"
                        elevation="0"
                        rounded="lg"
                        >                        
                        <v-img src="/img/speaker/speaker2.png">
                        <v-expand-transition>
                            <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out v-card--reveal text-h2 white--text"
                                style="height: 100%;"
                            >       
                            <div class="social-media">
                                <v-btn icon color="white">
                                        <v-icon>
                                            mdi-instagram
                                        </v-icon>
                                    </v-btn>
                                    <v-btn icon color="white">
                                        <v-icon>
                                            mdi-twitter
                                        </v-icon>
                                    </v-btn>
                                    <v-btn icon color="white">
                                        <v-icon>
                                            mdi-linkedin
                                        </v-icon>
                                    </v-btn>                        
                            </div>                                                         
                            </div>                                                        
                            </v-expand-transition>
                        </v-img>                        
                        </v-card>
                    </v-hover>                           
                    <div class="font-header4 text-center">Dr. Sang Ayu Putu Rahayu, S.H. M.H</div>
                    <p class="font-content2 text-center mx-auto" style="width: 80%">
                        Lecturer Of Law Faculty Univeresitas Negeri Semarang
                    </p>
                </v-col>
            </v-row>
            </div>
        </div>                
        <div class="news-box">            
            <div class="container-80 mx-auto">
            <div class="font-header2 secondary--text text-center">News</div>
            <p class="font-subheader2 text-center mx-auto">
                Get to know the latest update about our event via our blog post
            </p>
            <v-slide-group v-if="loadingNews">
                <v-slide-item v-for="i in 3" :key="i">
                    <v-col cols="" lg="4">
                        <v-card class="mx-auto d-flex flex-column" elevation="6" min-width="248">
                            <v-skeleton-loader                        
                            type="image, article, actions"
                        ></v-skeleton-loader>
                        </v-card>                        
                    </v-col>
                </v-slide-item>
            </v-slide-group>
            <v-slide-group v-else>                
                <v-slide-item v-for="(item, i) in news" :key="i">
                     <v-col v-if="i < 3" cols="" lg="4">
                        <v-card class="mx-auto d-flex flex-column" elevation="6" min-width="248">                            
                            <v-img :src="item.image"></v-img>                            
                            <v-card-title class="font-header6 primary--text">
                                {{limitTitle(item.title)}}
                            </v-card-title>                                                                                     
                            <v-card-text class="font-content5" v-text="removeTag(item.content)">
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <router-link :to="'news/'+item.path" class="link-text2 secondary--text mx-auto">Read 
                                    <v-icon>
                                        mdi-arrow-right
                                    </v-icon>
                                </router-link>
                            </v-card-actions>   
                        </v-card>
                    </v-col>
                </v-slide-item>                
            </v-slide-group>            
            <!-- <v-row>
               
                <v-col cols="4">
                    <v-card class="mx-auto" elevation="6">
                        <v-img src="https://assets.pikiran-rakyat.com/crop/93x279:1101x894/x/photo/2021/07/06/2981264881.jpg">

                        </v-img>
                        <v-card-title class="font-subheader2">
                            Sword art online
                        </v-card-title>
                        <v-card-text class="font-content3">
                            NBLC Summit merupakan ... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer feugiat neque metus, nec pellentesque eros auctor at. Aliquam nec arcu sed eros viverra elementum. 
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <router-link to="" class="link-text2 secondary--text mx-auto">
                                Read 
                                <v-icon>
                                    mdi-arrow-right
                                </v-icon>
                            </router-link>
                        </v-card-actions>   
                    </v-card>
                </v-col>
                <v-col cols="4">
                    <v-card class="mx-auto" elevation="6">
                        <v-img src="https://assets.pikiran-rakyat.com/crop/93x279:1101x894/x/photo/2021/07/06/2981264881.jpg">

                        </v-img>                        
                        <v-card-title class="font-subheader2">
                            Sword art online
                        </v-card-title>
                        <v-card-text class="font-content3">
                            NBLC Summit merupakan ... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer feugiat neque metus, nec pellentesque eros auctor at. Aliquam nec arcu sed eros viverra elementum. 
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <router-link to="" class="link-text2 secondary--text mx-auto">
                                Read 
                                <v-icon>
                                    mdi-arrow-right
                                </v-icon>
                            </router-link>
                        </v-card-actions>                        
                    </v-card>
                </v-col>
            </v-row> -->            
            <div class="mx-auto news-more" style="width: max-content">
                <router-link to="news" class="link-text2 secondary--text mx-auto">
                    Learn More 
                    <v-icon>
                        mdi-arrow-right
                    </v-icon>
                </router-link>
            </div>            
        </div>
        </div>    
        <dialog-message :show="showDialog" :message="message" @close="showDialog = false"/>                
    </div>        
</template>
<script>
import Header from "../components/HeaderHome.vue"
import Footer from "../components/FooterHome.vue"
import DialogMessage from "../components/subscribe/dialogMessage.vue"
import { mapActions, mapGetters } from 'vuex'

export default {
    props: ['scrollToSubscribe'],
    components: {
        Header,
        Footer,
        'dialog-message' : DialogMessage
    },
    data: () => ({
        items : [
            {                
                title : 'The 7th National Business Law Community Summit 2021',
                subtitle : 'NBLC Summit is a forum event of official and unofficial members, which consist of Accountability report within one period, recruitment of official members of NBLC and establishment of new officers for the next period.',
                link : ''
            },
            {                
                title : 'Find Out More About The Impact of Omnibus Law on Foreign Investment in Indonesia',
                subtitle : 'National Webinar The 7th NBLC Summit Come Up With The Theme  “Perubahan Iklim Investasi Atas Berlakunya UU No. 11 Tahun 2020 tentang Ciptakerja Terhadap Foreign Direct Investment di Tengah Percepatan Pertumbuhan Ekonomi Nasional”',
                link : ''
            },
            {                
                title : 'Improve your skills through a National Paper Presentation Competition',
                subtitle : 'Paper Presentation Competition is a competition to analyze cases that have been given from a legal point of view in writing in the form of a Paper of Research based on the applicable regulations in Indonesia',
                link : ''
            },
        ],        
        timeline1: '',
        timeline2: '',
        vl1: '',
        vl2: '',
        timelineMarginTop: '',
        form : {
            email : ''
        },
        message : [],
        showDialog: false,
        news: [],
        loadingNews: true,
        about: {},
        loadingHeader: true,
        carousel: 0,
        sponsor: [],
        loadingSponsor: true,
        subscribeFocus : false
    }),
    async mounted(){        
        this.setTimeline1()
        this.setTimeline2()        
        window.addEventListener('resize', () => {
            this.setTimeline1()
            this.setTimeline2()            
        }),
        await this.loadAbout()
        this.about = this.getAbout        
        this.about = this.setContentHeader
        this.loadingHeader = false
        if(this.getEventSubscribe){
            this.$refs[`inputSubscribe${this.carousel}`][0].focus()                
        }
        this.setEventSubscribe(false)        
        await this.loadNews(1)               
        this.news = this.getNews[0] 
        this.loadingNews = false          
        if(!this.getLoadingSponsor){
            this.sponsor = this.getSponsor[0]
            this.loadingSponsor = false
        }   
    },    
    methods: {
        ...mapActions(['loadAbout','subscribe', 'loadNews', 'setEventSubscribe']),        
        setTimeline1(){
            let timeline = this.$refs.timeline1            
            let timelineMargin = window.getComputedStyle(timeline).marginBottom
            this.timeline1 = timeline.clientHeight + parseInt(timelineMargin)

            let timelineFirst = this.$refs.timeline_first
            let timelineFirstMargin = window.getComputedStyle(timelineFirst).marginBottom
            this.timelineMarginTop = timelineFirst.clientHeight + parseInt(timelineFirstMargin)
        },
        setTimeline2(){
            let timeline = this.$refs.timeline2
            let timelineMargin = window.getComputedStyle(timeline).marginBottom
            this.timeline2 = timeline.clientHeight + parseInt(timelineMargin)
            this.vl2 = this.$refs.vl2.clientHeight
        },
        async subscribeHandler(){
            await this.subscribe(this.form)
            .then(() => {                
                this.message = {email: ['you have subscribed now, to see the latest info please see email']}
                this.showDialog = true
            }).catch(error => {                
                this.message = error.response.data.message
                this.showDialog = true
            })
        },      
        limitTitle(title){
            return title.length > 40 ? title.substring(0, 40).trim() + '...' : title
        },  
        limitParagraph(text){            
            if(!/<[^>]*>/.test(text)){
                return text.substring(0, 100) + '...'
            }                 
            
            var indexText, countAllText, indexTag = 0
            let defaultText = text.replace(/<[^>]*>/g, ' <| <0> |> ')                                                            
            defaultText = defaultText.split(/<\||\|>/) 
            defaultText = defaultText.filter(item => item.trim() != '')                                  
            let tag = text.match(/<[^>]*>/g)            
            let countText = []                              
            defaultText.forEach((item, i) => {
                countText.push(!/<0>/.test(item) ? item.length : 0)                
                countAllText = countText.reduce((total, num) => total + num)               
                if(countAllText >= 100 && indexText == undefined){
                    indexText = i                                                    
                }
            });                                              
            defaultText[indexText] = defaultText[indexText]
            .substring(0, 100 - countText.slice(0, indexText)
            .reduceRight((total, num) => total + num)) + '...'            
            return defaultText.map((item, i, self) => {
                if(/<0>/.test(item)){
                    indexTag++
                    return tag[indexTag - 1]
                }else{
                    return item
                }                
            }).join('')
        },
        removeTag(text){            
            text = text.replace(/<[^>]*>/g, '')
            return text.length >= 110 ? text.substring(0, 110).trim() + '...' : text
        }
    },
    computed: {
        ...mapGetters(['getNews', 'getAbout', 'getEventSubscribe', 'getLoadingSponsor', 'getSponsor']),            
        setContentHeader(){
            return this.about.map(item => {
                let contentHeader = ''                
                switch (item.id) {
                    case 1:
                        contentHeader = 'NBLC Summit is a forum event of official and unofficial members, which consist of Accountability report within one period, recruitment of official members of NBLC and establishment of new officers for the next period. The NBLC Summit 2021 will be held at Universitas Negeri Semarang.'
                        break
                    case 2: 
                        contentHeader = 'National Webinar The 7th NBLC Summit Come Up With The Theme  “Perubahan Iklim Investasi Atas Berlakunya UU No. 11 Tahun 2020 tentang Ciptakerja Terhadap Foreign Direct Investment di Tengah Percepatan Pertumbuhan Ekonomi Nasional”'
                        break
                    case 3:  
                        contentHeader = 'Paper Presentation Competition is a competition to analyze cases that have been given from a legal point of view in writing in the form of a Paper of Research based on the applicable regulations in Indonesia'
                        break                                  
                }
                return {
                    id : item.id,
                    title: item.title,
                    content: item.content,
                    image : item.image,
                    created_at : item.created_at,
                    updated_at : item.updated_at,
                    path : item.path,
                    contentHeader
                }
            })
        },
        carouselSponsor(){
            return this.sponsor.filter(item => item.position === 'carousel')
        },
        contentSponsor(){
            return this.sponsor.filter(item => item.position === 'content')
        }
    },
    watch: {
        getEventSubscribe(data){                        
            if(data){
                this.$refs[`inputSubscribe${this.carousel}`][0].focus()                
            }            
            this.setEventSubscribe(false)
        },
        getLoadingSponsor(data){
            this.loadingSponsor = data  
            console.log(data)
            if(!data){
                this.sponsor = this.getSponsor[0]
            }
        }
    }     
}
</script>
<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;  
  position: absolute;
  width: 100%;
}

.v-card--reveal::after {
  content: "";
  background-color: #B69D74;
  opacity: 0.7;
  position: absolute;
  width: 100%;
  height: 100%;
}

.social-media{        
    position: absolute;    
    z-index: 1;    
}

.social-media .v-btn{            
    margin-right: calc(1vw + 1px);
    margin-left: calc(1vw + 1px);
}
</style>
