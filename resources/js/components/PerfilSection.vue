<template>
	<div>
		<perfilUser @checkUser="checkUser" :user="user"></perfilUser>
	</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props:{
        	user:{

        	}
        },

        methods:{
            checkUser(){
                console.log("0");
                this.$emit("checkUser");                 
            }
        }
    }
</script>
