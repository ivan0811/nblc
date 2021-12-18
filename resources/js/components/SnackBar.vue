<template>
    <div>
         <v-snackbar
            v-model="alert"
            :timeout="timeout"
            :color="color"            
            >
            {{ text }}

            <template v-slot:action="{ attrs }">
                <v-btn
                color="white"
                text
                v-bind="attrs"
                @click="$emit('close')"
                >
                Close
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>
<script>
export default {
    props: ['snackbar', 'status'],
    data:() => ({
        timeout: 2000,
        color: '',
        text: '',
        alert: false
    }),    
    watch: {
        status(data){            
            switch (data) {
            case 'success':
                this.text = 'Data saved successfully'
                this.color = 'green'
                break;
            case 'error':
                this.color = 'red lighten-1'
                this.text = 'Data failed to save'
                break;            
            }
        },
        snackbar(data){            
            this.alert = data            
        }        
    }
}
</script>