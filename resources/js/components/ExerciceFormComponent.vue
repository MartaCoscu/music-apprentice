<template>
    <div class="ma-container">
      <div>
        <v-touch @swipeleft="swipeleft()">
          <p>I can now be swiped on!</p>
      </v-touch>
      <v-touch @rotate="rotateAThing">
          <p>Rotate me!</p>
      </v-touch>
  </div>
</div>
</template>

<script>

    export default {
       data() {
        return {
        };
    },

    mounted() {
        console.log('Component mounted.')
    },

    methods: {
        swipeleft(){
            console.log("swipe left")
        }
    }
}
</script>
