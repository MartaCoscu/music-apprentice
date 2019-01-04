<template>
	<a href="" v-on:click.prevent="onSelect"><div class="ma-opcion">
		<img class="ma-icon" v-bind:src="img"></img>
		{{ name }}
	</div></a>
</template>

<script>

    export default {
    	props: ['name', 'img'],
        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            onSelect(){
                console.log('select'),
                this.$emit("onSelect"); 
            }
        }
    }
</script>
