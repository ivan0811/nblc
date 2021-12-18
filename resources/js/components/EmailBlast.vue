<template>
<div>
    <v-dialog
      v-model="dialogEmailBlast"
      persistent
      max-width="800px"          
    >      
      <v-card>
        <v-card-title>
          <span class="text-h5">Email Blast</span>
        </v-card-title>
        <v-card-text>
          <v-container>              
               <tiptap-vuetify
                    class="my-5"
                    v-model="form.email_body"
                    :extensions="extensions"       
                    :toolbar-attributes="{dense: true, color: 'greyLight', class: 'rounded-t-lg'}"         
                    :card-props="{flat: true, outlined: true, height: '58vh', rounded: 'lg'}"    
                    placeholder="Write message here..."                    
                >   

                </tiptap-vuetify>                                                               
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
            <v-btn elevation="0" color="primary" @click="sendHandler">
                <v-icon>
                    mdi-send
                </v-icon>
                <div class="ml-1">
                    Send
                </div>                        
            </v-btn>
        </v-card-actions>  
      </v-card>
    </v-dialog>              
    <error-dialog :showError="showError" :errors="errors" @close="showError = false"/>
    </div>
</template>
<script>
import { TiptapVuetify, Heading, Bold, Italic, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'
import errorDialog from './errorSendEmail.vue'
export default {
    props: ['dialogEmailBlast', 'errors'],
    components: {
        'tiptap-vuetify' : TiptapVuetify,
        'error-dialog' : errorDialog
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
            email_body : ''
        },
        showError : false            
    }),
    methods: {
        sendHandler(){
            this.$emit('send', this.form)
            if(!!this.errors){
                this.showError = true
            }
        }
    }
}
</script>
<style>
    .tiptap-vuetify-editor__content{
        height: 80% !important;        
    }
    .tiptap-vuetify-editor__content > div{
        height: 80% !important;        
    }
</style>