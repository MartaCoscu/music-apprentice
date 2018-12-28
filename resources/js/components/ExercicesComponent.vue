<template>
    <div>
        count {{ exercices.length }}
        <button v-on:click.prevent="next">next</button>
        <button v-on:click.prevent="prev">prev</button>

        <siema ref="siema" class="ma-siema" :options="options"  @init="initFunc" @change="changeFunc" :ready="false">
            <div class="slide" v-for="exercice in exercices" 
                :key="exercice.id"
                :exercice = "exercice">
                <exercice :exercice = "exercice"></exercice> 
            </div>        
        </siema>
    </div>    
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

                ],
                window: {
                    width: 0,
                    height: 0,
                    mobile: false
                }
            }
        },



        mounted() {
            window.addEventListener('resize', this.handleResize)
            this.handleResize();
            axios.get('/exercices').then((response) => {
                this.exercices = response.data;
                console.log("exercices: " + this.exercices); 
                this.$refs.siema.init(); 
            });

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
