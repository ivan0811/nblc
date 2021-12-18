<template>
    <div>              
        <v-row v-if="loading">
            <v-col cols="4" v-for="i in 3" :key="i">
                <v-card>
                    <v-skeleton-loader                        
                        type="image, list-item-two-line, article, actions"
                    ></v-skeleton-loader>
                </v-card>                
            </v-col>
        </v-row>
        <v-row v-else>            
            <v-col cols="4" v-for="item in about" :key="item.id">
                <v-card>
                    <v-img height="209px" :src="item.image ? item.image : 'https://i.stack.imgur.com/y9DpT.jpg'">
                    </v-img>
                    <v-card-title>
                        {{item.title.length > 40 ? item.title.substring(0, 40) + '...' : item.title}}
                    </v-card-title>
                    <v-card-text v-html="item.contentHeader.length > 150 ? item.contentHeader.substring(0, 150) + '...' : item.contentHeader">                        
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="editNews(item.id)">
                            <v-icon>
                                mdi-pencil-outline
                            </v-icon>
                        </v-btn>                        
                    </v-card-actions>
                </v-card>
            </v-col>                                                         
        </v-row>                 
        <edit-dialog :detail="detailAbout" :editDialog="editDialog" @close="editDialog = false" @save="updateAbout" :errors="error"/>
        <snackbar-dialog :status="statusSnackbar" :snackbar="showSnackbar" @close="showSnackbar = false"/>
    </div>
</template>
<script>
import EditNewsDialog from '../../components/About/EditAboutDialog.vue'
import SnackBar from '../../components/SnackBar.vue'
import { mapActions, mapGetters } from 'vuex'
export default {
    components: {        
        'edit-dialog' : EditNewsDialog,        
        'snackbar-dialog' : SnackBar
    },
    data: () => ({            
      about: {},
      loading: true,      
      editDialog: false,
      error: [''],
      showSnackbar: false,
      statusSnackbar: '',
      detailAbout: ['']                    
    }),
    async mounted(){
        await this.setAbout()
    },
    methods: {
        ...mapActions([
            'loadAbout',                        
            'patchAbout'            
        ]),                 
        async setAbout(){
            await this.loadAbout()
            this.about = this.getAbout
            this.about = this.setContentHeader
            this.loading = false            
        },
        removeAbout(data){                   
            this.about = this.about.filter(item => item.id != data.id)
        },        
        pushAbout(data){            
            this.about.push(data)
            this.about = this.setContentHeader
        },                
        async updateAbout(form){                                    
            await this.patchAbout(form)                                         
            .then(res => {                                
                this.editDialog = false                 
                this.statusSnackbar = 'success'
                this.showSnackbar = true                                        
                this.removeAbout(this.detailAbout)                                
                this.pushAbout(res.data)                       
                this.detailAbout = ['']                                 
            }).catch(err => {                            
                this.statusSnackbar = 'error'
                this.showSnackbar = true
                this.error = err.response.data.message
                this.loading = false
            })          
        },
        editNews(id){    
            this.error = ['']        
            this.detailAbout = this.about.filter(item => item.id == id)[0]
            this.editDialog = true            
        }        
    },
    computed: {
        ...mapGetters([
            'getAbout'            
        ]),
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
                    contentHeader
                }
            })
        }
    }
}    
</script>