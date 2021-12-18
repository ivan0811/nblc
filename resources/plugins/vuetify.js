import Vue from 'vue'
import Vuetify from 'vuetify'
import { TiptapVuetifyPlugin } from 'tiptap-vuetify'
import 'tiptap-vuetify/dist/main.css'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
import { reduce } from 'lodash'

Vue.use(Vuetify)

const vuetify =  new Vuetify({
    theme: {
        themes: {
            light: {
                primary: "#B69D74",
                secondary: "#B69D74",
                darkBlue: "#64758e",
                pastel: "#D1DCE5",
                light: "#FFFFFF",
                bg: "#FBFBFB",                
                grey: "#9A9590",
                greyLight: '#F6F6E6'                
            },
        },
    },
})

Vue.use(TiptapVuetifyPlugin, {
    vuetify,
    iconsGroup: 'mdi'
})

export default vuetify
