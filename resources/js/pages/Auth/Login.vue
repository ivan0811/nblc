<template>
    <div style="height: 100vh; background-color: #FBFBFB" class="d-flex">
        <v-card width="400px" rounded="lg" class="mx-auto align-self-center">
            <v-container v-if="token">
                <div class="main-logo-dark mb-6"></div>
                <form action="" @submit.prevent="loginHandler">
                    <v-text-field 
                        outlined                         
                        dense 
                        class="mb-3"
                        v-model="form.email" 
                        label="Email" 
                        type="email" 
                        color="secondary"      
                        :error="!!errors.email"
                        :rules="errors.email"
                    ></v-text-field>
                    <v-text-field 
                        outlined                         
                        dense 
                        v-model="form.password" 
                        class="mb-3"                        
                        label="Password" 
                        type="password" 
                        color="secondary"        
                        :error="!!errors.password"
                        :rules="errors.password"               
                    ></v-text-field>
                    <router-link to="" class="secondary--text link-text2">Forgot Password?</router-link>
                    <div style="width: 100%" class="mt-2">
                        <v-btn class="font-button" type="submit" block elevation="0" color="secondary">Login</v-btn>
                    </div>                                           
                </form>
            </v-container>
        </v-card>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    data: () => ({
        form: {
            email: '',
            password: ''
        },        
        autofilled: false,
        errors: [],
        token: true
    }),      
    mounted(){
        const token = localStorage.getItem('token')
        if(token) {
            this.token = false
            this.$router.go(-1)
        }
    },
    methods: {
        ...mapActions(['login', 'loadProfile']),
        async loginHandler(){
            await this.login(this.form)
            .then(async () => {
                await this.loadProfile()
                this.$router.push('dashboard')                
            }).catch(err => {
                console.log(err.response.status)
                if(err.response.status == 401){
                    this.errors = {
                        email : ['The email is incorrect'],
                        password: ['The password is incorrect']
                    }                    
                }else if(err.response.status == 403){
                    this.errors = err.response.data.message
                }
            })                        
        }
    }    
}
</script>