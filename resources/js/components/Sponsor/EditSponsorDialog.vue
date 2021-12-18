<template>  
    <v-dialog
      v-model="editDialog"
      persistent
      max-width="600px"
    >      
      <v-card>
        <v-card-title>
          <span class="text-h5">Edit Sponsor</span>
        </v-card-title>
        <v-card-text>
          <v-container>                          
              <v-row class="mt-5">                  
                  <v-col cols="6">
                    <v-img :src="blobImage ? blobImage : 'https://i.stack.imgur.com/y9DpT.jpg'" width="200px">
                    </v-img>
                  </v-col>
                  <v-col cols="6">
                    <v-select 
                        :items="positions"
                         label="Position"                                                                             
                        v-model="form.position"
                        outlined
                        dense
                        :rules="errors.position"
                        :error="!!errors.position"         
                    ></v-select>
                  </v-col>
                  <v-col cols="6">
                      <v-select
                        :items="['URL', 'File']"
                        label="Logo From"                                                                
                        v-model="form.imageFrom"
                        outlined
                        dense                        
                        >
                    </v-select>
                  </v-col>
                  <v-col cols="6">
                    <v-text-field
                        label="Input Logo from Web URL"
                        v-if="form.imageFrom == 'URL'"  
                        v-model="form.image"              
                        outlined
                        dense           
                        :rules="errors.image"
                        :error="!!errors.image"                                             
                    >   
                    </v-text-field>
                    <v-file-input
                            v-else
                            accept="image/*"
                            label="Input Logo From Local File"
                            v-model="form.image"
                            @change="imageHandler"
                            outlined
                            dense   
                            :rules="errors.image"
                            :error="!!errors.image"                                 
                        >
                    </v-file-input>   
                  </v-col>
                  <v-col cols="6">
                    <v-text-field
                        label="Brand Name"                                
                        outlined
                        dense       
                        v-model="form.brand"
                        :rules="errors.brand"
                        :error="!!errors.brand"         
                    >
                    </v-text-field>                       
                  </v-col>
                  <v-col cols="6">
                    <v-text-field
                        label="Website"                                          
                        outlined
                        dense
                        v-model="form.link"
                        :rules="errors.link"
                        :error="!!errors.link"                        
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
</template>
<script>
export default {
    props: ['editDialog', 'positions', 'errors', 'detailSponsor'],
    data: () => ({
        form: {
            id: '',
            imageFrom: 'URL',            
            image: '',
            brand: '',
            link: '',
            position: ''
        },
        blobImage: ''
    }),    
    methods:{
        imageHandler(e){            
            this.blobImage = URL.createObjectURL(e)        
        }        
    },    
    watch:{
        'form.imageFrom'(){
            this.form.image = ''
        },
        detailSponsor(data){            
            let detail = data[0]        
            this.form.id = detail.id
            this.form.brand = detail.brand
            this.form.link = detail.link
            this.form.position = detail.position        
            this.blobImage = detail.image  
        }        
    }    
}
</script>