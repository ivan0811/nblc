<template>  
<div>
    <v-dialog
      v-model="editDialog"
      persistent
      width="400px"
    >      
      <v-card>
        <div class="d-flex justify-space-between">
          <v-card-title>
            <span class="text-h5">Edit User</span>
          </v-card-title>
          <v-btn icon large @click="$emit('close')">
            <v-icon large>
              mdi-close
            </v-icon>            
          </v-btn>
        </div>        
        <v-card-text>
          <v-container>                          
              <v-row class="mt-5">                                                                                      
                  <v-col cols="12">
                    <v-text-field
                        label="Name"                                
                        outlined
                        dense       
                        v-model="form.name"
                        :rules="errors.name"
                        :error="!!errors.name"
                    >
                    </v-text-field>                       
                  </v-col>                  
                  <v-col cols="12">
                    <v-text-field
                        label="Email"                                
                        outlined
                        dense       
                        type="email"
                        v-model="form.email"
                        :rules="errors.email"
                        :error="!!errors.email"         
                    >
                    </v-text-field>                       
                  </v-col>                  
              </v-row>                                                               
          </v-container>          
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="grey"
            text
            @click="$emit('close')"
          >
            Close
          </v-btn>
          <v-btn
            color="primary"            
            @click="$emit('save', form)"            
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>  
    
  </div>    
</template>
<script>

export default {
    props: ['editDialog', 'errors', 'detailUser'],    
    data: () => ({
        form: {            
            name: '',            
            email: '',
            id: ''            
        },        
    }),    
    watch: {
      detailUser(data){        
        const detail = data[0]
        this.form.id = detail.id
        this.form.name = detail.name
        this.form.email = detail.email
      }
    }    
}
</script>