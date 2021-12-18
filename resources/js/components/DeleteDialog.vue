<template>  
    <v-dialog
      v-model="deleteDialog"
      persistent
      max-width="400px"
    >      
      <v-card>
        <v-card-title>
          <span class="text-h5">Confirm Delete</span>
        </v-card-title>
        <v-card-text>
          Are You sure want to delete {{data}}?     
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
            color="red red lighten-1"            
            dark        
            @click="$emit('delete')"            
          >
            Delete
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>  
</template>
<script>
export default {
    props: ['deleteDialog', 'data'],    
}
</script>