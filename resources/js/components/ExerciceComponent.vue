<template>
    <div>

                <div>
                        Holi {{ exercice.name }} adios
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
