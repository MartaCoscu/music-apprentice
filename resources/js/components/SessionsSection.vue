<template>
<div>
		<createSection v-if="add"  @list="onList()" @onShow="onShow"></createSection>

		<sessionsList v-if="list" @add="onAdd()" @onShow="onShow"></sessionsList>

		<showSession :id="current" v-if="show" @add="onAdd()" @list="onList()" @onShow="onShow"></showSession>       
      
</div>
</template>

<script>
    export default {

    data(){
        return {
            add: false, 
            list: true,
            show: false,
            edit: false,
            current: 0
        }
    },

        mounted() {
            console.log('Component mounted.')
        },

        methods:{
	        	onShow(id){  
	        		console.log("show"); 
		            this.current = id; 
		            this.add = false;
		            this.list = false;
		            this.show = true;
		            this.edit = false; 
		        },
    	    
        	onList(){
                console.log("list"); 
	            this.add = false;
	            this.list = true;
	            this.show = false;
	            this.edit = false;
        	},

        	onAdd(){
	            this.add = true; 
	            this.list = false;
	            this.show = false;
	            this.edit = false;
	            console.log("do add")
        	}


        }
    }
</script>
