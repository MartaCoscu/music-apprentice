<template>
    <div>

                <div v-html="exercice.description">
                </div>
          
    </div>
</template>

<script>
    export default {

        props: ['exercice'],

       data() {
            return {
                editMode: false
            };
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
