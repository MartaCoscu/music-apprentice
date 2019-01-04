<template>
    <div>

<div class="ma-parameters">
    <div class="ma_playing_timer ma-degradado"><input type="number" v-model="timer" max="3600" name=""></div>
   
    <div class="ma_playing_metronome ma-degradado"><form method="POST" action="" v-on:submit.prevent="updateMetronome()"><input type="number" v-model="myTempo" max="250" min="40" name=""></form></div>

</div>
        
        

        <p class="showExercicePlaying" v-html="realText"></p>
    </div>

</template>

<script>

    export default {
        props: {
            exercice:{},
            session:{},
            index:{},
            currentIndex:{}
        },


        watch:{
            currentIndex(){
                if (this.index == this.currentIndex){
                    this.playing = true; 
                    this.uploadTimer(); 
                    this.uploadMetronome();
                } else {
                    this.playing = false; 
                }
            }
        },

        data() {
            return {
                playing: false,
                timer: 0,
                name: "", 
                tempo: "",
                myTempo: "",
                seconds: "",
                fullExercice:{

                },
                realText: '',
                
            };
        },

        mounted() {

            let formData = new FormData();
            formData.append('session', this.session);
            formData.append('exercice', this.exercice);

            axios.post('/exerciceInSession', formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            })
            .then((response) => {
             console.log(response); 
             this.name = response.data.name;
             this.tempo = response.data.tempo;
             this.myTempo = this.tempo;
             this.seconds = response.data.seconds;
             this.timer = this.seconds;  
             this.fullExercice = response.data.exercice; 
             this.realText = this.fullExercice.text.split('[[').join('<');
             this.realText = this.realText.split(']]').join('>');

             if (this.index == this.currentIndex){
                this.playing = true; 
                this.uploadTimer(); 
                this.uploadMetronome();
            } else {
                this.playing = false; 
            }
        })
            .catch((error) => {
                console.log("error" + error)
            })        
        },
        destroyed() {
          this.playing = false;   
      },

      methods:{
        onBack(){
            this.$emit("onList"); 
        },

        updateMetronome(){
            this.tempo = this.myTempo; 
        },
        uploadTimer(){
 
            if (this.playing == true){
                console.log("timer"); 
                const self = this;    
                this.timer = parseInt(this.timer)-1;        
                if (this.timer <= 0){
                    this.$emit("onNext");
                }
                setTimeout(function(){
                    self.uploadTimer(); 
                },1000,"JavaScript");                   
            }
        },

        uploadMetronome(){
            if (this.playing == true){
                var audio = new Audio('metronome.wav');
                audio.play(); 
                const self = this;          
                var time = 60000/this.tempo;
                setTimeout(function(){
                    self.uploadMetronome(); 
                },time,"JavaScript");                  
            }

        }

    }
}
</script>
