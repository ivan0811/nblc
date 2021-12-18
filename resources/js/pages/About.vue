<template>
    <div class="detail-box">
        <div class="text-center mx-auto primary--text font-header0" style="width: 80%">{{detail.title}}</div>                
        <div class="container-80 mx-auto" style="margin-bottom: 10%">                  
            <div v-html="detail.contentHeader" class="font-content2 text-center" style="margin-top: 2%"></div>            
        </div>
        <div class="mx-auto font-content2" style="width: max-content"></div>
        <v-img :src="detail.image" width="100%" style="margin-top: 10%; margin-bottom: 7%"></v-img>        
        <div class="container-80 mx-auto" style="margin-bottom: 10%">                  
            <div v-html="detail.content" class="font-content2" style="margin-top: 2%"></div>            
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    data: () => ({
        loading: true,
        detail: {}
    }),
    async mounted(){
        await this.loadDetailAbout(this.$route.params.slug)        
        this.detail = this.getDetailAbout
        this.detail.contentHeader = this.getContentHeader
        this.loading = false
    },
    methods: {
        ...mapActions([
            'loadDetailAbout',            
        ])        
    },
    computed: {
        ...mapGetters([
            'getDetailAbout'
        ]),
         getContentHeader(){
            let contentHeader = ''
             switch (this.detail.id) {
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
            return contentHeader           
        }
    }
}
</script>