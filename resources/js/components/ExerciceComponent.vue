<template>
    <div>
        <div v-html="realText">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['exercice'],

        data() {
            return {
                realText: '',
                editMode: false
            };
        },

        mounted() {
            console.log('Component mounted.');

            this.realText = this.exercice.text.split('[[').join('<');
            this.realText = this.realText.split(']]').join('>');

        }
    }
</script>
