<template>
    <div>
        <v-main app class="bg-admin ml-10 pt-5">                        
            <div class="font-header3">{{header[0].title}}</div>             
        </v-main>                
    </div>
</template>
<script>
import { mapGetters } from 'vuex'

export default {    
    data : () => ({
        header: ['']
    }),
    mounted() {
        this.setHeader()
    },
    methods:{
        setHeader(){
            this.header = this.getPage.auth.filter(item => {
                return item.name == this.$route.name.toLowerCase()
            })
        }
    },    
    computed: {
        ...mapGetters([
            'getPage'
        ])
    },
    watch: {
        $route(to, from){
            this.setHeader()
        }
    }
}
</script>