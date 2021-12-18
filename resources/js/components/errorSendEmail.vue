<template>  
    <v-dialog
      v-model="showError"
      persistent
      max-width="300px"
    >      
      <v-card>
        <v-card-title>
          <span class="text-h5">Information</span>
        </v-card-title>
        <v-card-text>
          {{errors.email_body ? errors.email_body[0] : ''}}
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>          
          <v-btn
            text
            @click="$emit('close')"
          >
            OK
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>  
</template>
<script>
export default {
    props: ['showError', 'errors']   
}
</script>