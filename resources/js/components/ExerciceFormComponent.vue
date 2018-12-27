<template>
    <div>
        <!-- bind a tap event -->

<!-- bind the swipe event, no matter direction -->
<span v-touch:moving="movingHandler">Continuously triggering Event</span>
    </div>
</template>

<script>
import Vue2TouchEvents from 'vue2-touch-events'

    export default {
     data() {
        return {
        };
    },

    mounted() {
        console.log('Component mounted.')
    },

    methods: {
        swipeleft(){
            console.log("swipe left")
        },

        movingHandler(uno, dos){
            alert("hace algo"); 
            console.log("uno: " + uno); 
        }
    }
}
</script>
