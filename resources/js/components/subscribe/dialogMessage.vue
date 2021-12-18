<template>  
    <v-dialog
      v-model="show"
      persistent
      max-width="400px"
    >      
      <v-card>
        <v-card-title>
          <span class="text-h5">Message</span>
        </v-card-title>
        <v-card-text>
          {{!!message.email ? message.email[0] : ''}}
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="grey"
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
    props: ['show', 'message'],    
    watch: {
        show(data){
            console.log(data)
        },
        message(data){
            console.log(data.email[0])
        }
    }
}
</script>