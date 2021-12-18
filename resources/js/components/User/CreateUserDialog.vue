<template>  
<div>
    <v-dialog
      v-model="createDialog"
      persistent
      width="600px"
    >      
      <v-card>
        <div class="d-flex justify-space-between">
          <v-card-title>
            <span class="text-h5">Add Usew</span>
          </v-card-title>          
        </div>        
        <v-card-text>
          <v-container>                          
              <v-row class="mt-5">                                                                                      
                  <v-col cols="6">
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
                  <v-col cols="6">
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
                  <v-col cols="6">
                    <v-text-field
                        label="Alternative Email"                                
                        outlined
                        dense       
                        v-model="form.alternative_email"
                        :rules="errors.alternative_email"
                        :error="!!errors.alternative_email"         
                    >
                    </v-text-field>                       
                  </v-col>
                  <v-col cols="6">
                    <v-text-field
                        label="Password"                                
                        outlined
                        dense       
                        type="password"
                        v-model="form.password"
                        :rules="errors.password"
                        :error="!!errors.password"         
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
    props: ['createDialog', 'errors'],    
    data: () => ({
        form: {
            name: '',            
            email: '',
            alternative_email: '',
            password: ''
        },        
    }),
    mounted(){
       
    },
    methods:{
        imageHandler(e){            
            this.blobImage = URL.createObjectURL(e)        
        }        
    }    
}
</script>