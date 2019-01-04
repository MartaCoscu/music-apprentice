<template>
	<div>	
		<exerciceForm v-if="add"  @list="onList()" @onShow="onShow"></exerciceForm>
		<exercices v-if="list" @add="onAdd()" @onShow="onShow"></exercices>
        <exercice v-if="show" @onEdit="onEdit" @onList="onList()"  :exercice=current></exercice>
        <exerciceForm v-if="edit"  @list="onList()" @onShow="onShow" :edit="true"   :exercice=current></exerciceForm>

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
            current: {
            }
        }
    },


    mounted() {
        console.log('Component mounted.')
    },

    methods:{
       onAdd(){
            this.add = true; 
            this.list = false;  
            this.show = false; 
            this.edit = false; 
      },

      onList(){
            this.current = {};
            this.add = false; 
            this.list = true;
            this.show = false;
            this.edit = false;  
      },

      onEdit(id){
        axios.get('/exercices/'+id,
        {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then((response) => {
            this.current = response.data.exercice; 
                 console.log(this.current); 

            this.add = false; 
            this.list = false;
            this.show = false; 
            this.edit = true; 

        })
        .catch((error) => {
            console.log("error" + error)
        })
      },


      onShow(id){
        axios.get('/exercices/'+id,
        {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then((response) => {
            this.current = response.data.exercice; 
            console.log(this.current); 
            this.add = false; 
            this.list = false;
            this.show = true; 
            this.edit = false; 

        })
        .catch((error) => {
            console.log("error" + error)
        })
    },           
},
}
</script>
