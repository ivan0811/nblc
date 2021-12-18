<template>
    <div>
         <div class="d-flex justify-space-between">
            <div style="width: 50%">
                <v-text-field solo label="Search" append-icon="mdi-magnify"></v-text-field>            
            </div>              
            <div class="d-flex">                
                <v-btn @click="downloadCSVData" class="ml-3" elevation="0" color="green" style="color: white" large>
                    <v-icon>
                        mdi-file-table
                    </v-icon>
                    <div class="ml-1">
                        Export CSV
                    </div>                    
                </v-btn>
                <v-btn @click="dialogEmailBlast = true" class="ml-3" elevation="0" color="primary" large>
                    <v-icon>
                        mdi-email-send
                    </v-icon>
                    <div class="ml-1">
                        Email Blast
                    </div>                    
                </v-btn>
            </div>            
        </div> 
        <template>
            <v-data-table
                :headers="headers"
                :items="subscriber"
                :items-per-page="5"
                class="elevation-1"
                :loading="loading"
                loading-text="Loading... Please wait"
            >
            <template v-slot:item="row">
                <tr>
                    <td>{{row.item.email}}</td>
                    <td>
                        <div class="d-flex justify-end">                            
                            <v-btn icon>
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
        <email-blast @send="sendEmailBlast" :dialogEmailBlast="dialogEmailBlast" @close="dialogEmailBlast = false" :errors="errors" />                    
        <error-dialog :showError="showError" :errors="errors" @close="showError = false"/>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import emailBlast from '../../components/EmailBlast.vue'
import errorDialog from '../../components/errorSendEmail.vue'
export default {
    components: {
        'email-blast' : emailBlast,
        'error-dialog' : errorDialog
    },
    data: () => ({
        headers: [
            {
                text: 'Subscriber',
                align: 'start',
                value: 'email'                
            },
            {
                text: 'Action',
                align: 'end'
            },                   
        ],
        subscriber:[
            {
                
            }
        ],
        loading: true,
        dialogEmailBlast: false,
        errors: [],
        showError: false
    }),
    async mounted() {
        await this.loadSubscriber()
        this.subscriber = this.getSubscriber        
        this.loading = false
    },
    methods: {
        ...mapActions(['loadSubscriber', 'sendMail']),
        downloadCSVData(){
            let csv = 'Subscriber\n'
            this.subscriber.forEach((row) => {
                csv += row.email + "\n"
            })
            const anchor = document.createElement('a')
            anchor.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv)
            anchor.target = '_blank'
            anchor.download = 'subscriber.csv'
            anchor.click()            
        },
        async sendEmailBlast(form){
            await this.sendMail(form)
            .then(res => {
                this.dialogEmailBlast = false
                this.errors = res.message
                this.showError = true                
            }).catch(err => {            
                this.errors = err.response.data.message
            })
        }
    },
    computed:{
        ...mapGetters(['getSubscriber'])
    }
}
</script>