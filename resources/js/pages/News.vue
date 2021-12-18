<template>
    <div>
        <div class="news-jumbroton">
            <div class="image-news">
                <div class="cover mx-auto" style="width: max-content">
                    <div class="font-header1 light--text text-center mx-auto">
                        Stay Updated and Never miss a post about NBLC Summit
                    </div>
                    <div class="font-subheader2 light--text text-center mx-auto">
                        Get to Know the latest update about National Business Law Community Summit via our News post.
                    </div>                                   
                </div>
            </div>
        </div>
        <div class="container-80 mx-auto page-news-box">
            <v-row class="pb-0">
                <v-col v-if="loading && page == 1" cols="12" class="first-news">                                        
                    <v-card flat class="d-flex mx-auto" height="20vw" min-width="248">                        
                            <v-skeleton-loader
                                width="50%"                          
                                height="100%"      
                                type="image"                                
                            ></v-skeleton-loader>                                                         
                            <v-skeleton-loader
                                style="margin-left: 2%"
                                width="50%"
                                type="article"
                            ></v-skeleton-loader>                                                    
                        </v-card> 
                </v-col>
                <v-col v-if="!loading && page == 1" cols="12" class="first-news">                
                    <v-card :to="`news/${news[0].path}`" flat :class="windowsSize >= 600 ? 'd-flex' : ''" class="mx-auto" min-width="248">                                                
                            <v-img :width="isResponsive ? '50%' : '100%'" :src="news[0].image">
                            </v-img>                                             
                            <div>
                                <v-card-text class="font-content2 pb-0 pt-0">
                                    {{news[0].date}}
                                </v-card-text>                                
                                <v-card-title class="font-header2 primary--text">
                                    {{limitTitle(news[0].title)}}
                                </v-card-title>
                                <v-card-text class="font-content2">
                                    {{removeTag(news[0].content)}}
                                </v-card-text>                            
                            </div>                                
                        </v-card>                    
                </v-col>             
                <v-col cols="12" style="margin-top: 2%; margin-bottom: 2%" v-if="page == 1">
                    <v-divider></v-divider>
                </v-col>                                                                                     
            </v-row>
            <v-row class="pt-0" v-if="loading">
                <v-col v-for="i in 6" :key="i"  cols="" lg="4" md="4" sm="6">
                    <v-skeleton-loader                        
                        type="image, article"
                    ></v-skeleton-loader>
                </v-col>                             
            </v-row>
            <div v-else>
                <v-row class="pt-0">
                    <v-col v-for="(item, i) in page == 1 ? addNewsDivider.slice(2) : addNewsDivider" 
                    :key="i" cols="" 
                    :lg="item === 'divider' ? 12 : 4" 
                    :md="item === 'divider' ? 12 : 4" 
                    :sm="item === 'divider' ? 12 : 6"
                    v-show="item !== 'divider' || item === 'divider' && activeDivider.includes(i) || item === 'divider' && activeDivider.length == 0"
                    >
                        <v-card v-if="item !== 'divider'" :to="'news/' + item.path" flat>
                            <v-img class="image-card-news" :src="item.image">
                            </v-img>
                            <v-card-text class="font-content pb-0">
                                {{item.date}}
                            </v-card-text>                            
                            <v-card-title class="font-header3 primary--text">
                                {{limitTitle(item.title)}}
                            </v-card-title>
                            <v-card-text class="font-content">
                                {{removeTag(item.content)}}
                            </v-card-text>  
                        </v-card>         
                        <v-divider v-else-if="activeDivider.includes(i) || activeDivider.length == 0"></v-divider>                                                                             
                    </v-col>                                  
                    <!-- <v-col cols="12" style="margin-top: 2%; margin-bottom: 2%">                        
                    </v-col>                                                  -->
                </v-row>
            </div>            
        </div>
        <div class="mx-auto" style="margin-bottom: 5%">
            <v-pagination
                class="custom-pagination"
                v-model="page"                
                :length="pagination.last_page"
                :total-visible="7"                                        
                prev-icon="previous"     
                next-icon="next"                                            
            ></v-pagination>
        </div>        
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    data: () => ({
        responsive: '',
        news: '',
        page: 1,
        pagination: {},
        loading: true,
        windowsSize: 0,
        activeDivider: []
    }),
    async mounted() {        
        await this.setNews()
        window.addEventListener('resize', () => {
            this.windowsSize = window.innerWidth
            this.setDivider()
        })
        this.windowsSize = window.innerWidth
        this.setDivider()
    },  
    methods: {
        ...mapActions([
            'loadNews'
        ]),
        setDivider(){
            if(window.innerWidth > 954){                
                this.activeDivider = [5]
            }else if(window.innerWidth > 598 && window.innerWidth <= 954){                
                this.activeDivider = [3, 7]
            }else if(window.innerWidth <= 598){
                this.activeDivider = []
            }   
        },
        removeTag(text){            
            text = text.replace(/<[^>]*>/g, '')
            return text.length >= 100 ? text.substring(0, 100).trim() + '...' : text
        },
        async setNews(page = 1){
            await this.loadNews({page, public: true})
            this.news = this.getNews[0]
            this.pagination = this.getNews.pagination
            this.loading = false
        },
        limitTitle(title){
            return title.length > 30 ? title.substring(0, 30).trim() + '...' : title
        },
        keyNews(i){
            console.log(i)
        }
    },
    computed: {
        ...mapGetters([
            'getNews'
        ]),
        addNewsDivider(){        
            let temp = []    
            this.news.forEach((item, i) => {
                console.log(item)
                console.log(i)
                temp.push(item)                
                temp.splice(i+7, 0, 'divider')                           
                // if(i > 0){                                                                                     
                // }
            });
            console.log(temp)
            return temp
        },        
        isResponsive(){
            return this.windowsSize >= 600
        }   
    },
    watch: {
        async page(page){ 
            this.loading = true
            await this.setNews(page)
        }        
    }
}
</script>