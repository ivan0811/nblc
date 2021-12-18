<template>
    <div>        
        <div class="d-flex justify-space-between">
            <div style="width: 50%">
                <v-text-field solo label="Search" append-icon="mdi-magnify"></v-text-field>            
            </div>                                               
            <v-btn @click="createDialog = true" elevation="0" large color="secondary" :disabled="loading">
                <v-icon>
                    mdi-plus
                </v-icon>
                <div class="ml-1">
                    Add Sponsor
                </div>                
            </v-btn>
        </div>  
        <div v-if="loading" class="mx-auto my-5" style="width: max-content">
            <v-progress-circular                            
                indeterminate
                color="secondary"                            
            ></v-progress-circular>
        </div> 
        <v-card v-else>                        
                <v-tabs
                 v-model="tab" 
                 slider-color="light" 
                 fixed-tabs
                 background-color="secondary"
                 dark
                 >
                    <v-tab v-for="item in positions" :key="item.position">
                        {{item.position}}
                    </v-tab>
                </v-tabs>                        
                <v-tabs-items
                    v-model="tab"
                >
                    <v-tab-item 
                        v-for="item in positions"
                        :key="item.position"                        
                    >                                      
                    <div v-if="sponsors[item.position].length < 1" class="font-header4 mx-auto pt-5" style="height: 50vh; width: max-content">
                        Data Not Found
                    </div> 
                        <v-simple-table v-else fixed-header height="50vh">
                            <template v-slot:default>
                                <thead>
                                    <tr>
                                        <th>
                                            Logo
                                        </th>
                                        <th>
                                            Brand
                                        </th>
                                        <th>
                                            Website
                                        </th>     
                                        <th>
                                            Actions
                                        </th>                                   
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    <tr v-for="sponsor in sponsors[item.position]" :key="sponsor.id">
                                        <td>
                                            <v-img :src="sponsor.image" width="50px"></v-img>
                                        </td>                                   
                                        <td>
                                            {{sponsor.brand}}
                                        </td>     
                                        <td>
                                            <router-link :to="sponsor.link" style="color: #B69D74">{{sponsor.link}}</router-link>                                            
                                        </td>
                                        <td>
                                            <v-btn icon @click="editSponsor(sponsor.id, sponsor.position)">
                                                <v-icon>
                                                    mdi-pencil-outline
                                                </v-icon>
                                            </v-btn>
                                            <v-btn icon @click="showDeleteDialog(sponsor.brand, sponsor.id, sponsor.position)">
                                                <v-icon>
                                                    mdi-delete
                                                </v-icon>
                                            </v-btn>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                    </v-tab-item>
                </v-tabs-items>
        </v-card>
        <create-dialog :createDialog="createDialog" @close="createDialog = false" @save="saveSponsor" :positions="limitPosition" :errors="error"/>
        <edit-dialog :detailSponsor="detailSponsor" :editDialog="editDialog" @close="editDialog = false" @save="updateSponsor" :positions="editPosition" :errors="error"/>
        <delete-dialog @delete="deleteSponsor" :data="deleteDialog.data" :deleteDialog="deleteDialog.show" @close="deleteDialog.show = false"/>
        <snackbar-dialog :status="statusSnackbar" :snackbar="showSnackbar" @close="showSnackbar = false"/>
    </div>
</template>
<script>
import CreateSponsorDialog from '../../components/Sponsor/CreateSponsorDialog.vue'
import EditSponsorDialog from '../../components/Sponsor/EditSponsorDialog.vue'
import DeleteDialog from '../../components/DeleteDialog.vue'
import SnackBar from '../../components/SnackBar.vue'
import FormData from 'form-data'
import { mapActions, mapGetters } from 'vuex'
export default {
    components: {
        'create-dialog' : CreateSponsorDialog,
        'edit-dialog' : EditSponsorDialog,
        'delete-dialog' : DeleteDialog,
        'snackbar-dialog' : SnackBar
    },
    data: () => ({
      tab: null,
      positions: [
          'header',
          'carousel',
          'content',
          'all'
      ],
      sponsors: {},
      loading: true,
      createDialog: false,
      editDialog: false,
      error: [],
      showSnackbar: false,
      statusSnackbar: '',
      detailSponsor: [''],
      editPosition: '',
      deleteDialog: {
          position: '',
          data: '',
          id: '',
          show: false
      }
    }),
    async mounted(){
        await this.loadAll()
        this.loading = false
    },
    methods: {
        ...mapActions([
            'loadSponsor',
            'loadPosition',
            'storeSponsor',
            'patchSponsor',
            'destroySponsor'
        ]),      
        async loadAll(){
            await this.loadSponsor()                       
            await this.loadPosition()
            this.positions.forEach(position => {
                this.sponsors[position] = this.getSponsor[0].filter(item => {
                    return item.position == position
                })
            })            
            this.positions = this.getPosition            
        },
        createForm(form){
            this.showSnackbar = false
            const formData = new FormData()            
            if(form.imageFrom == 'URL'){
                formData.append('imageURL', form.image)
            }else{
                console.log(form.image)
                formData.append('imageFile', form.image)
            }
            formData.append('brand', form.brand)
            formData.append('link', form.link)
            formData.append('position', form.position)
            if(form.id != undefined){                
                formData.append('id', form.id) 
            }                         
            return formData
        },
        pushSponsor(data){
            this.positions.filter(item => item.position == data.position)
            .map(item => item.total++)
            this.sponsors[data.position].push(data)
        },
        removeSponsor(data){
            this.positions.filter(
                item => item.position == data.position
            ).map(item => item.total--)                
            this.sponsors[data.position] 
            = this.sponsors[data.position]
            .filter(item => item.id != data.id)
        },
        async saveSponsor(form){            
            const formData = this.createForm(form)            
            await this.storeSponsor(formData)              
            .then(res => {                                
                this.createDialog = false                 
                this.statusSnackbar = 'success'
                this.showSnackbar = true 
                // this.removeSponsor(this.detailSponsor[0])                
                this.pushSponsor(res.data[0])                
            }).catch(err => {                
                console.log(err)            
                this.statusSnackbar = 'error'
                this.showSnackbar = true
                this.error = err.response.data.message                
            })            
        },
        async updateSponsor(form){            
            const formData = this.createForm(form)                                      
            await this.patchSponsor(formData)                             
            .then(async res => {                
                this.editDialog = false                 
                this.statusSnackbar = 'success'
                this.showSnackbar = true                                               
                this.positions.filter(
                    item => item.position == this.detailSponsor[0].position
                ).map(item => item.total--)                
                this.sponsors[this.detailSponsor[0].position] 
                = this.sponsors[this.detailSponsor[0].position]
                .filter(item => item.id != this.detailSponsor[0].id)
                this.pushSponsor(res.data[0])       
                this.detailSponsor = ['']    
                this.editPosition = []
            }).catch(err => {                            
                this.statusSnackbar = 'error'
                this.showSnackbar = true
                this.error = err.response.data.message
                this.loading = false
            })          
        },
        editSponsor(id, position){    
            this.error = []        
            this.detailSponsor = this.sponsors[position].filter(item => item.id == id)         
            this.editPosition = this.limitPosition            
            this.editDialog = true            
        },
        showDeleteDialog(data, id, position){
            this.deleteDialog.position = position
            this.deleteDialog.data = data
            this.deleteDialog.id = id
            this.deleteDialog.show = true
        },
        resetDeleteDialog(){
            this.deleteDialog.position = ''
            this.deleteDialog.data = ''
            this.deleteDialog.id = ''            
        },
        async deleteSponsor(){            
            console.log(true)
            await this.destroySponsor(this.deleteDialog.id)
            .then(() => {      
                this.removeSponsor(this.deleteDialog)
                this.statusSnackbar = 'success'
                this.showSnackbar = true  
                this.deleteDialog.show = false
                this.resetDeleteDialog()
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
            'getSponsor',
            'getPosition'
        ]),
        limitPosition(){            
            return this.positions.filter(
                item => item.total < item.limit 
                || item.limit == 0 
                || item.position == this.detailSponsor[0].position
            ).map(item => item.position)            
        }        
    }    
}
</script>