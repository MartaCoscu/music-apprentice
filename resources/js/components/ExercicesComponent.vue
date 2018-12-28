<template>
<div>exercices</div>
    
</template>

<script>
    export default {

        data(){
            return{                    
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
      
                exercices:[
                    {
                        name: "uno"
                    },
                    {
                        name: "dos"
                    },
                    {
                        name: "tres"
                    },
                ],
                window: {
                    width: 0,
                    height: 0,
                    mobile: false
                }
            }
        },



        mounted() {
      /*      axios.get('/exercices').then((response) => {
                this.exercices = response.data;
                console.log("exercices: " + this.exercices); 
            });*/

            console.log('Component mounted.')
        },
        created() {
            window.addEventListener('resize', this.handleResize)
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize)
        },

        methods: {
            initFunc(){
                console.log("init"); 
            },

            changeFunc(){
                console.log("change");                 
            },

            next(){
                console.log("next"); 
                this.$refs.siema.next();
            },

            prev(){
                console.log("next"); 
                this.$refs.siema.prev();
            },

            handleResize() {
                this.window.width = window.innerWidth;
                this.window.height = window.innerHeight;
                if (this.window.width > 992){
                    this.window.greater = true; 
                }else {
                    this.window.greater = false; 
                }
            }        
        }
    }
</script>
