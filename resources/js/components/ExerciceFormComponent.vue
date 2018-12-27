<template>
    <div>
    <a v-touch:tap="callback">Tap me!</a>
    <div v-touch:swipe="callback">Swipe me!</div>
    </div>
</template>

<script>
    import { BasicSelect } from 'vue-search-select';

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

        callback(uno, dos){
            console.log("uno: " + uno); 

            console.log("dos: " + dos);
        }
    }
}
</script>
