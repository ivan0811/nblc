<template>  
<div>
    <v-dialog
      v-model="editDialog"
      persistent
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
    >      
      <v-card>
        <div class="d-flex justify-space-between">
          <v-card-title>
            <span class="text-h5">Edit About</span>
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
                    <v-img :src="blobImage ? blobImage : 'https://i.stack.imgur.com/y9DpT.jpg'" width="700px">
                    </v-img>
                  </v-col>                                                  
                  <v-col cols="12">
                    <v-text-field
                        label="Title"                                
                        outlined
                        dense       
                        v-model="form.title"
                        :rules="errors.title"
                        :error="!!errors.title"         
                        disabled
                    >
                    </v-text-field>                                                               
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      :value="form.contentHeader"
                      disabled       
                      outlined
                      dense               
                    >
                    </v-textarea>
                  </v-col>
                  <v-col cols="12">                                        
                    <tiptap-vuetify
                      class="my-5"
                      v-model="form.content"
                      :extensions="extensions"       
                      :toolbar-attributes="{dense: true, color: 'greyLight', class: 'rounded-t-lg'}"         
                      :card-props="{flat: true, outlined: true, height: '100vh', rounded: 'lg'}"    
                      placeholder="Write content here..."                                          
                    >   
                    </tiptap-vuetify>                     
                    <div class="text-caption "></div>
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
            @click="saveHandler"            
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>  
    <alert-dialog @close="showAlertDialog = false" :alertDialog="showAlertDialog" :errors="errors"/>
  </div>    
</template>
<script>
import alertDialog from  './aboutAlertDialog.vue'
import { TiptapVuetify, Heading, Bold, Italic, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'
export default {
    props: ['editDialog', 'errors', 'detail'],

    components: {
        'tiptap-vuetify' : TiptapVuetify,
        'alert-dialog' : alertDialog
    },    
    data: () => ({
       extensions: [
            History,
            Blockquote,
            Link,
            Underline,
            Strike,
            Italic,
            ListItem,
            BulletList,
            OrderedList,
            [Heading, {
                options: {
                levels: [1, 2, 3]
                }
            }],
            Bold,            
            Code,
            HorizontalRule,
            Paragraph,
            HardBreak
        ],        
        form: {            
            contentHeader: '',
            image: '',
            title: '',
            content: '',
            id: ''
        },
        blobImage: '',
        showAlertDialog: false        
    }),
    methods:{
        imageHandler(e){            
            this.blobImage = URL.createObjectURL(e)        
        },  
        saveHandler(){
          this.$emit('save', this.form)                               
        }
    },    
    watch:{                
        detail(data){
          let detail = data                    
          this.blobImage = detail.image
          this.form.title = detail.title
          this.form.content = detail.content
          this.form.id = detail.id
          this.form.contentHeader = data.contentHeader
        },
        errors(data){                    
          if(data.content != null && !this.showAlertDialog){
            this.showAlertDialog = true
          }          
        }
    }    
}
</script>
<style>
.tiptap-vuetify-editor__content{
        height: 90% !important;        
    }
    .tiptap-vuetify-editor__content > div{
        height: 90% !important;        
    }
</style>