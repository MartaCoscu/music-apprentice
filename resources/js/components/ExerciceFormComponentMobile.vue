<template>
    <exerciceEditor @updatedHtml="updateContent"></exerciceEditor>
</template>

<script>

    export default {
       data() {
        return {
            options: {
                duration: 200,
                easing: 'ease-out',
                perPage: 1,
                startIndex: 0,
                draggable: true,
                multipleDrag: true,
                threshold: 20,
                loop: false,
                rtl: false
            },

        };
    },

    mounted() {
        console.log('Component mounted.')
    },

    methods: {
        next(){
            console.log("next"); 
            this.$refs.siema.next();
        },

        prev(){
            console.log("next"); 
            this.$refs.siema.prev();
        },

    }
}
</script>
