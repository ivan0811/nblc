<template>
    <div>      
        <div class="d-flex justify-space-between">
            <div style="width: 50%">
                <v-text-field solo label="Search" append-icon="mdi-magnify"></v-text-field>            
            </div>            
            <v-btn elevation="0" large color="secondary" @click="createDialog = true;statusCreated = false">
                <v-icon>
                    mdi-plus
                </v-icon>
                <div class="ml-1">
                    Add News
                </div>                
            </v-btn>
        </div>  
        <v-row v-if="loading">
            <v-col cols="4" v-for="i in 6" :key="i">
                <v-card>
                    <v-skeleton-loader                        
                        type="image, list-item-two-line, article, actions"
                    ></v-skeleton-loader>
                </v-card>                
            </v-col>
        </v-row>
        <v-row v-else>            
            <v-col cols="4" v-for="item in news" :key="item.id">
                <v-card>
                    <v-img height="209px" :src="item.image ? item.image : 'https://i.stack.imgur.com/y9DpT.jpg'">
                    </v-img>
                    <v-card-title>
                        {{item.title.length > 40 ? item.title.substring(0, 40) + '...' : item.title}}
                    </v-card-title>
                    <v-card-text v-html="item.content.length > 150 ? item.content.substring(0, 150) + '...' : item.content">                        
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="editNews(item.id)">
                            <v-icon>
                                mdi-pencil-outline
                            </v-icon>
                        </v-btn>
                        <v-btn icon @click="showDeleteDialog('News', item.id)">
                            <v-icon>
                                mdi-delete
                            </v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>                                                         
        </v-row>
         <v-pagination
            v-model="page"
            class="my-4"
            :length="pagination.last_page"
            :total-visible="7"
        ></v-pagination>
        <create-dialog :status="statusCreated" :createDialog="createDialog" @close="createDialog = false" @save="saveNews" :errors="error"/>
        <edit-dialog :detailNews="detailNews" :editDialog="editDialog" @close="editDialog = false" @save="updateNews" :errors="error"/>
        <delete-dialog @delete="deleteNews" :data="deleteDialog.data" :deleteDialog="deleteDialog.show" @close="deleteDialog.show = false"/>
        <snackbar-dialog :status="statusSnackbar" :snackbar="showSnackbar" @close="showSnackbar = false"/>
    </div>
</template>
<script>
import CreateNewsDialog from '../../components/News/CreateNewsDialog.vue'
import EditNewsDialog from '../../components/News/EditNewsDialog.vue'
import DeleteDialog from '../../components/DeleteDialog.vue'
import SnackBar from '../../components/SnackBar.vue'
import FormData from 'form-data'
import { mapActions, mapGetters } from 'vuex'
export default {
    components: {
        'create-dialog' : CreateNewsDialog,
        'edit-dialog' : EditNewsDialog,
        'delete-dialog' : DeleteDialog,
        'snackbar-dialog' : SnackBar
    },
    data: () => ({            
      news: {},
      loading: true,
      createDialog: false,
      editDialog: false,
      error: [''],
      showSnackbar: false,
      statusSnackbar: '',
      detailNews: [''],      
      deleteDialog: {          
          data: '',
          id: '',
          show: false
      },
      statusCreated: false,
      page: 1,
      pagination: {}
    }),
    async mounted(){
        await this.setNews()
    },
    methods: {
        ...mapActions([
            'loadNews',            
            'storeNews',
            'patchNews',
            'destroyNews'
        ]),                 
        async setNews(page = 1){
            await this.loadNews({page, public: false})
            this.news = this.getNews[0]
            this.loading = false
            this.pagination = this.getNews.pagination               
        },
        createForm(form){
            this.showSnackbar = false
            const formData = new FormData()                       
            if(form.imageFrom == 'URL'){
                formData.append('imageURL', form.image)
            }else{                    
                formData.append('imageFile', form.image)
            }                                    
            formData.append('title', form.title)            
            formData.append('content', form.content)
            if(form.id != undefined){                
                formData.append('id', form.id) 
            }                           
            return formData
        },
        pushNews(data){            
            this.news.push(data)
        },
        removeNews(data){                   
            this.news = this.news.filter(item => item.id != data.id)
        },
        async saveNews(form){
            const formData = this.createForm(form)                 
            await this.storeNews(formData)              
            .then(res => {                                
                this.createDialog = false                 
                this.statusSnackbar = 'success'
                this.showSnackbar = true      
                if(this.news.length < 6){
                    this.pushNews(res.data[0])                
                }                         
                this.statusCreated = true       
            }).catch(err => {                            
                this.statusSnackbar = 'error'
                this.showSnackbar = true
                this.error = err.response.data.message                
            })            
        },
        async updateNews(form){            
            const formData = this.createForm(form)                
            await this.patchNews(formData)                             
            .then(res => {                                
                this.editDialog = false                 
                this.statusSnackbar = 'success'
                this.showSnackbar = true                     
                this.removeNews(this.detailNews)                
                this.pushNews(res.data[0])                       
                this.detailNews = ['']                                 
            }).catch(err => {                            
                this.statusSnackbar = 'error'
                this.showSnackbar = true
                this.error = err.response.data.message
                this.loading = false
            })          
        },
        editNews(id){    
            this.error = ['']        
            this.detailNews= this.news.filter(item => item.id == id)[0]
            this.editDialog = true            
        },
        showDeleteDialog(data, id){            
            this.deleteDialog.data = data
            this.deleteDialog.id = id
            this.deleteDialog.show = true
        },
        resetDeleteDialog(){            
            this.deleteDialog.data = ''
            this.deleteDialog.id = ''            
        },
        async deleteNews(){                        
            await this.destroyNews(this.deleteDialog.id)
            .then(async () => {                      
                this.statusSnackbar = 'success'
                this.showSnackbar = true  
                this.deleteDialog.show = false
                this.removeNews(this.deleteDialog)
                this.resetDeleteDialog()
                this.loading = true
                await this.setNews()                
            }).catch(err => {
                this.statusSnackbar = 'error'
                this.showSnackbar = true
                console.error(err)
                this.resetDeleteDialog()
            })          
        }
    },
    computed: {
        ...mapGetters([
            'getNews',            
        ])        
    },
    watch: {
        async page(page){ 
            this.loading = true
            await this.setNews(page)
        }
    }
}    
</script>