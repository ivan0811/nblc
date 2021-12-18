<template>  
    <v-dialog
      v-model="alertDialog"
      persistent
      max-width="300px"
    >      
      <v-card>
        <v-card-title>
          <span class="text-h5">Warning!</span>
        </v-card-title>
        <v-card-text>
          {{errors.content ? errors.content[0] : ''}}
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
    props: ['alertDialog', 'errors']   
}
</script>