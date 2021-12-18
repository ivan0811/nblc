<template>  
  <v-dialog
      v-model="show"
      persistent
      max-width="400px"
    >      
      <v-card>
        <v-card-title>
          <span class="text-h5">Confirm Old Password</span>
        </v-card-title>
        <v-card-text>
          <v-container>    
               <v-text-field
                label="Password"                                
                outlined
                dense       
                v-model="oldPassword"
                :rules="errors.password"
                :error="!!errors.password" 
                type="password"        
            >
            </v-text-field>                                      
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
            @click="$emit('save', oldPassword)"            
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>       
</template>
<script>
export default {
    props: ['show', 'errors'],    
    data: () => ({
        oldPassword : ''        
    }),           
}
</script>