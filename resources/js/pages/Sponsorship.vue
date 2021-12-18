<template>
    <div>
        <div class="sponsorship-jumbroton">
            <div class="image-sponsorship">
                <div class="cover mx-auto" style="width: max-content">
                    <div class="font-header1 light--text text-center mx-auto">
                        Become Sponsors of The 7th NBLC Summit 2021
                    </div>
                    <div class="font-subheader2 light--text text-center mx-auto">
                        The event partnership with NBLC Summit promises maximum Brand Awareness and Brand Recognition through Publication to all business law students in Indonesia.
                    </div>
                    <div class="mx-auto" style="width: max-content; margin-top: 3vw">
                        <div class="d-flex">                            
                            <button class="font-button default-button" style="margin-right: 3vw">
                                Contact Us
                            </button>                            
                            <button class="font-button outlined-default-button">
                                View Proposal
                            </button>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>  
        <div class="default-box sponsorship-page">
            <div class="container-80 mx-auto">
                <div class="font-header2 primary--text mx-auto" style="width: max-content">Our Supporters</div>
                <div class="font-header4 mx-auto" style="width: max-content">Sponsors & Partners</div>
                <v-row>
                    <v-col cols="" lg="4" md="4" sm="6" xs="12" v-for="sponsor in sponsors" :key="sponsor.id">                                                
                        <v-card>
                            <a :href="sponsor.link">
                                <v-img :src="sponsor.image"></v-img>   
                            </a>                            
                        </v-card>                           
                    </v-col>
                </v-row>
            </div>            
        </div>               
        <div class="become-sponsors-box mx-auto">
            <div class="content">
                <div class="font-header3 text-center mx-auto primary--text">
                    Become  Sponsors and Partners Of The 7th NBLC Summit 2021 
                </div>               
                <div class="mx-auto" style="width: max-content">
                    <button class="primary-button font-button">
                        Contact Us
                    </button>                                          
                </div>                
            </div>                      
        </div>                                    
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    data: () => ({
        sponsors: []
    }),
    async mounted(){
        await this.loadSponsor()
        this.sponsors = this.getSponsor[0]
    },
    methods: {
        ...mapActions([
            'loadSponsor'
        ])
    },
    computed: {
        ...mapGetters([
            'getSponsor'
        ])
    }
}
</script>