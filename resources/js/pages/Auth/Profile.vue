<template>
    <div>
        <v-col cols="12">            
            <v-card>
                <v-container>
                    <v-row>
                        <v-col cols="12">                                                            
                            <div class="font-header4">{{name}}</div>                                                                     
                        </v-col>
                        <v-col cols="6">
                            <v-text-field
                                outlined
                                dense
                                label="Email"
                                type="email"
                                v-model="form.email"                                
                                :rules="errors.email"
                                :error="!!errors.email"   
                            ></v-text-field>
                        </v-col>           
                        <v-col cols="6">
                            <v-text-field
                                outlined
                                dense
                                label="Alternative Email"
                                type="email"
                                v-model="form.alternative_email"
                                :rules="errors.alternative_email"
                                :error="!!errors.alternative_email" 
                            ></v-text-field>
                        </v-col>           
                        <v-col cols="6">
                            <v-text-field
                                outlined
                                dense
                                label="New Password"
                                type="password"
                                v-model="form.newPassword"
                                :rules="errors.newPassword || errors.confirmPassword"
                                :error="!!errors.newPassword || errors.confirmPassword"                                 
                            ></v-text-field>
                        </v-col>           
                        <v-col cols="6">
                            <v-text-field
                                outlined
                                dense
                                label="Confirm Password"
                                type="password"
                                v-model="form.confirmPassword"
                                :rules="errors.confirmPassword"
                                :error="!!errors.confirmPassword" 
                            ></v-text-field>
                        </v-col>           
                    </v-row>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn elevation="0" color="greyLight" @click="resetHandler">
                            <v-icon>
                                mdi-arrow-u-left-bottom
                            </v-icon>
                            <div class="ml-1">
                                Reset
                            </div>                            
                        </v-btn>
                        <v-btn elevation="0" color="primary" @click="showPasswordDialog = true">
                            <v-icon>
                                mdi-content-save
                            </v-icon>
                            <div class="ml-1">
                                Save
                            </div>                            
                        </v-btn>
                    </v-card-actions>
                </v-container>            
                </v-card>
        </v-col>
        <password-dialog :show="showPasswordDialog" :errors="errors" @save="saveHandler" @close="showPasswordDialog = false"></password-dialog>
        <snackbar-dialog :status="statusSnackbar" :snackbar="showSnackbar" @close="showSnackbar = false"/>
    </div>
</template>
<script>
import passwordDialog from '../../components/PasswordDialog.vue'
import SnackBar from '../../components/SnackBar.vue'
import { mapActions, mapGetters } from 'vuex'
export default {
    components: {
        'password-dialog' : passwordDialog,
        'snackbar-dialog': SnackBar
    },
    data: () => ({
        form: {
            email : '',
            alternative_email: '',
            newPassword: '',
            confirmPassword: '',
            oldPassword: ''            
        },
        showPasswordDialog : false,
        errors: [],
        statusSnackbar: '',
        showSnackbar: false,
        name: ''
    }),
    mounted(){
        this.form.email = localStorage.getItem('email') 
        this.form.alternative_email = localStorage.getItem('alternative_email')
        this.name = localStorage.getItem('name')
    },
    methods: {
        ...mapActions(['loadProfile', 'updateProfile']),
        async saveHandler(oldPassword){
            this.form.oldPassword = oldPassword
            await this.updateProfile(this.form)
            .then(res => {  
                const data = this.getProfile
                this.form.email = data[0].email
                this.form.alternativeEmail = data[0].alternative_email 
                this.showPasswordDialog = false
                this.statusSnackbar = 'success'
                this.showSnackbar = true
            }).catch(err => {                
                this.errors = err.response.data.message                
                this.statusSnackbar = 'error',
                this.showSnackbar = true
                if(!this.errors.password){
                    this.showPasswordDialog = false
                }
            })
        },
        resetHandler(){
            this.form.email = localStorage.getItem('email') 
            this.form.alternative_email = localStorage.getItem('alternative_email')            
        }
    }    
}
</script>