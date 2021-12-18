<template>
    <div>
        <div class="d-flex justify-space-between">
            <div style="width: 50%">
                <v-text-field solo label="Search" append-icon="mdi-magnify"></v-text-field>            
            </div>              
            <v-btn elevation="0" large color="secondary" @click="createDialog = true">
                <v-icon>
                    mdi-plus
                </v-icon>
                <div class="ml-1">
                    Add User
                </div>                
            </v-btn>
        </div> 
        <template>
            <v-data-table
                :headers="headers"
                :items="users"
                :items-per-page="5"
                class="elevation-1"
                :loading="loading"
                loading-text="Loading... Please wait"
            >
            <template v-slot:item="row">
                <tr>
                    <td>{{row.item.name}}</td>
                    <td>{{row.item.email}}</td>                    
                    <td>{{row.item.alternative_email}}</td>
                    <td>
                        <div class="d-flex justify-end">
                            <v-btn icon @click="editNews(row.item.id)">
                                <v-icon>
                                    mdi-pencil-outline
                                </v-icon>
                            </v-btn>
                            <v-btn icon @click="showDeleteDialog(row.item.name, row.item.id)">
                                <v-icon>
                                    mdi-delete
                                </v-icon>
                            </v-btn>                
                        </div>        
                    </td>
                </tr>
            </template>
            </v-data-table>
        </template>
        <create-dialog :createDialog="createDialog" @close="createDialog = false" @save="saveUser" :errors="error"/>
        <edit-dialog :detailUser="detailUser" :editDialog="editDialog" @close="editDialog = false" @save="updateUser" :errors="error"/>
        <delete-dialog @delete="deleteUser" :data="deleteDialog.data" :deleteDialog="deleteDialog.show" @close="deleteDialog.show = false"/>
        <snackbar-dialog :status="statusSnackbar" :snackbar="showSnackbar" @close="showSnackbar = false"/>
    </div>
</template>
<script>
import CreateUserDialog from '../../components/User/CreateUserDialog.vue'
import EditUserDialog from '../../components/User/EditUserDialog.vue'
import DeleteDialog from '../../components/DeleteDialog.vue'
import SnackBar from '../../components/SnackBar.vue'
import { mapActions, mapGetters } from 'vuex'
export default {
     components: {
        'create-dialog' : CreateUserDialog,
        'edit-dialog' : EditUserDialog,
        'delete-dialog' : DeleteDialog,
        'snackbar-dialog' : SnackBar
    },
    data: () => ({
        headers: [
            {
                text: 'Name',
                align: 'start',
                value: 'name'
            },
            {
                text: 'Email',
                align: 'start',
                value: 'email'
            },
            {
                text: 'Alternative Email',
                align: 'start',
                value: 'alternative_email'
            },
            {
                text: 'Actions',
                align: 'end'                
            },
        ],
        users: [],
        loading: true,
        createDialog: false,
        editDialog: false,
        error: [],
        showSnackbar: false,
        statusSnackbar: '',
        detailUser: [],      
        deleteDialog: {          
            data: '',
            id: '',
            show: false
        }
    }),
    async mounted(){
        await this.loadUser()                
        this.users = this.getUser
        this.loading = false     
    },
    methods:{        
        ...mapActions([
            'loadUser',            
            'storeUser',
            'patchUser',
            'destroyUser'
        ]),                                
        pushUser(data){            
            this.users.push(data)
        },
        removeUser(id){                   
            this.users = this.users.filter(item => item.id != id)
        },
        async saveUser(form){                       
            await this.storeUser(form)              
            .then(res => {                
                this.createDialog = false                 
                this.statusSnackbar = 'success'
                this.showSnackbar = true                 
                this.pushUser(res.data)
            }).catch(err => {                            
                this.statusSnackbar = 'error'
                this.showSnackbar = true
                this.error = err.response.data.message                
            })            
        },
        async updateUser(form){                                    
            await this.patchUser(form)                             
            .then(async res => {                
                this.editDialog = false                 
                this.statusSnackbar = 'success'
                this.showSnackbar = true                                                                                           
                this.removeUser(this.detailUser[0].id)
                this.pushUser(res.data)       
                this.detailUser = []                    
            }).catch(err => {                            
                this.statusSnackbar = 'error'
                this.showSnackbar = true
                this.error = err.response.data.message
                this.loading = false
            })          
        },
        editNews(id){    
            this.error = ['']        
            this.detailUser= this.users.filter(item => item.id == id)
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
        async deleteUser(){                        
            await this.destroyUser(this.deleteDialog.id)
            .then(() => {                      
                this.statusSnackbar = 'success'
                this.showSnackbar = true  
                this.deleteDialog.show = false
                this.removeUser(this.deleteDialog.id)
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
        ...mapGetters(['getUser'])
    }
}
</script>