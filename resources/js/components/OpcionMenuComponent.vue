<template>
	<div class="ma-opcion">
		<img src="images/icons/icon.png"></img>
		{{ name }}
	</div>
</template>

<script>

    export default {
    	props: ['name'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
