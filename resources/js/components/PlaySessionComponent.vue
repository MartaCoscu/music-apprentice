<template>
    <div>

        <h1>{{ name }}</h1>

     <!--   <button v-on:click.prevent="prev">prev</button>
        <button v-on:click.prevent="next">next</button>
-->
        <siema ref="siema" :current.sync="curSlide" class="ma-siema" :options="options"  @init="initFunc" @change="changeFunc" :ready="false">

        <playingExercice @onNext="onNext" class="slide" @onShow="onShow(exercice)" v-for="(exercice, index) in exercices"
            :key="exercice.id"
            :exercice = "exercice.id"
            :session = "id"
            :index = "index"
            :currentIndex = "curSlide">
        </playingExercice>
        

            <!--<div class="slide" v-for="exercice in exercices" 
                :key="exercice.id"
                :exercice = "exercice">
                <exercice :exercice = "exercice"></exercice> 
            </div>   -->     
        </siema>
        </div>  
    </div>
</template>

<script>

    export default {
        props: {
            id: {}, 
            exercices:{}
        },

        data() {
            return {
                name: "", 
                curSlide: 0,
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
                window: {
                    width: 0,
                    height: 0,
                    mobile: false
                }                
            };
        },

        mounted() {
            console.log("show session");
            window.addEventListener('resize', this.handleResize)
            this.handleResize();
            this.$refs.siema.init(); 
        },
        created() {
            window.addEventListener('resize', this.handleResize)
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize)
        },


        methods:{
            onBack(){
                this.$emit("onList"); 
            },
            initFunc(){
                console.log("init"); 
            },

            changeFunc(){
                console.log("change: " + this.$refs.siema.currentSlide); 
                this.currentIndex = this.$refs.siema.currentSlide;                
            },

            next(){
                console.log("next"); 
                this.$refs.siema.next();
            },

            prev(){
                console.log("next"); 
                this.$refs.siema.prev();
            },

            onNext(){
                if (this.curSlide < this.exercices.length-1){
                    console.log("entra aqui: " + this.curSlide + " / " + this.exercices.length-1 ); 
                    this.$refs.siema.next();                    
                } else {
                    this.$emit("onFinish");
                }
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
