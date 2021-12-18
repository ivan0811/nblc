   
<template>  
    <v-navigation-drawer
      v-model="drawer"
      floating
      permanent
      app      
      color="white"
      class="elevation-3"            
    >
    <div class="main-logo-dark my-4"></div>
        <v-divider></v-divider>
      <!-- <v-sheet        
        class="pa-4"
      >                
        <div>Admin</div>        
      </v-sheet>      
      <v-divider></v-divider> -->

      <v-list>         
       <v-list-item-group color="secondary">       
            <v-list-item
            v-for="[icon, text, name] in links"
            :key="icon"
            link             
            :to="{name}"       
            color="secondary"                                 
            >                    
            <v-list-item-icon>
                <v-icon :class="$route.name == name ? '' : 'nav'">{{ icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title :class="$route.name == name ? 'secondary--text' : 'grey--text'">{{ text }}</v-list-item-title>
            </v-list-item-content>

            <v-list-item-icon v-if="$route.name == name">
                <v-icon>mdi-chevron-right</v-icon>
            </v-list-item-icon>                   
            </v-list-item>        
       </v-list-item-group>
      </v-list>   
         

      <template v-slot:append>        
         <v-list>             
           <v-list-item-group color="secondary">
             <v-list-item
             link
             to="/profile"
            >
            <v-list-item-icon>
                <v-icon :class="$route.name == 'Profile' ? '' : 'nav'">
                    mdi-account
                </v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title :class="$route.name == 'Profile' ? 'secondary--text' : 'grey--text'">Profile</v-list-item-title>
            </v-list-item-content>

            <v-list-item-icon v-if="$route.name == 'Profile'">
                <v-icon>mdi-chevron-right</v-icon>
            </v-list-item-icon> 
            </v-list-item>

            <v-list-item
                link
                @click="logoutHandler()"
            >
                <v-list-item-icon>
                    <v-icon class="grey--text">
                        mdi-logout
                    </v-icon>                    
                </v-list-item-icon>

                <v-list-item-content>                    
                    <v-list-item-title class="grey--text">Logout</v-list-item-title>
                </v-list-item-content>
            </v-list-item>         
            </v-list-item-group>   
      </v-list>
      </template>            
    </v-navigation-drawer>     
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
  export default {
    data: () => ({      
      drawer: null,
      links: [
        ['mdi-view-dashboard', 'Dashboard', 'Dashboard'],        
        ['mdi-cash-multiple', 'Sponsor', 'Sponsor'],
        ['mdi-newspaper', 'News', 'ManageNews'],
        ['mdi-information', 'About', 'ManageAbout'],
        ['mdi-account-multiple-plus', 'Subscriber', 'Subscriber'],
        ['mdi-account-group', 'Users', 'User']
      ],
    }),    
    mounted(){        
      this.setLinks(localStorage.getItem('name') == 'admin')
    },
    methods: {
        ...mapActions(['logout', 'setProfile']),
        async logoutHandler(){
          await this.logout()
          .then(() => {
            this.setProfile('')
            this.$router.push('login')
            localStorage.removeItem('token')
            localStorage.removeItem('name')
            localStorage.removeItem('email')
            localStorage.removeItem('alternative_email')
          }).catch(err => {
            console.error(err)
          })
        },
        setLinks(isAdmin){
          if(!isAdmin){            
            this.links = this.links.filter(item => item[2] != 'User')
          }          
        }
    },
    computed: {
      ...mapGetters(['getProfile'])
    },
    watch: {
      getProfile(data){                
        this.setLinks(localStorage.getItem('name') == 'admin')
      }
    }
  }
</script>