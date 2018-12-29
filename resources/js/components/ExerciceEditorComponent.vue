<template>
    <div>

        <div class="ma-editor">
           <div class="ma-error" v-for="error in ma_errors">
            {{ error }}
        </div>
        <div class="ma-addFiles">
            oooh
            <input id="inputImg" v-on:change="onImgUploaded" accept=".jpg,.png"   name="input_img" type="file" style="display: none" />
            <div class="ma-addFileButton"><a v-on:click.prevent="onUploadImg" href=""><img src="images/icons/bt_img_off.jpg"/><img src="images/icons/bt_img_on.jpg"/></a></div>

            <input id="inputVideo" v-on:change="onVideoUploaded" type="file" accept=".mp4" name="input_video" style="display: none" />
            <div class="ma-addFileButton"><a v-on:click.prevent="onUploadVideo" href=""><img src="images/icons/bt_video_off.jpg"/><img src="images/icons/bt_video_on.jpg"/></a></div>

            <input id="inputAudio" v-on:change="onAudioUploaded" type="file" accept=".mp3,.wav" name="input_audio" style="display: none" />
            <div class="ma-addFileButton"><a href="" v-on:click.prevent="onUploadAudio"><img src="images/icons/bt_audio_off.jpg"/><img src="images/icons/bt_audio_on.jpg"/></a></div>
            <div class="ma-addFileButton"><img src="images/icons/bt_file_off.jpg"/></div>
        </div>
        <editor-content :editor="editor" />
    </div>

</div>
</template>

<script>
    import { Editor, EditorContent } from 'tiptap';

    export default {
        components: {
            EditorContent,
        },
        data() {
            return {
                file: '',
                ma_errors: [
                ],
                editor: new Editor({
                    content: "",

                    onUpdate: ({ getJSON, getHTML }) => {
                      this.html = getHTML()
                      this.$emit("updatedHtml", this.html); 
                  },
              }),
                html: ''
            }
        },

        mounted() {
            this.html = this.editor.getHTML();
            this.$emit("updatedHtml", this.html); 

        },
        beforeDestroy() {
            this.editor.destroy()
        },
        methods: {

            onUploadImg(){
                $("#inputImg").trigger("click");
            },

            onUploadVideo(){
                $("#inputVideo").trigger("click");
            },

            onUploadAudio(){

                $("#inputAudio").trigger("click");
            },

            onImgUploaded(e){
                this.onFileChange(e, 0);
            },
            onVideoUploaded(e){
                this.onFileChange(e, 1);
            },
            onAudioUploaded(e){
                this.onFileChange(e, 2);
            },            

            onFileChange(e, type) {
                this.ma_errors= [];
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                   // this.createImage(files[0]);
                   this.file = files[0];

                   if (this.file.size > 8000000){

                    this.ma_errors.push("Hubo un error al subir el archivo. Tamaño máximo: 8mb"); 
                } else {
                    let formData = new FormData();
                    formData.append('file', this.file);
                    

                    axios({
                        method: 'post',
                        url: '/upload',
                        headers:{'Content-Type': 'text/html; charset=utf-8', 'X-Content-Type-Options': 'nosniff'},
                        data: formData
                    })
                    .then((response) => {
                        console.log(response.data); 
                        let mystring = ""; 
                        switch (type){
                            case 0:
                            mystring ="[[img src='files/"+response.data.url+"' alt='imagen del ejercicio']]";

                            break; 

                            case 1: 
                            mystring = "[[video width='320' height='240' controls]][[source src='files/"+response.data.url+"'; type='video/mp4']]Tu navegador no soporta el video]][[/video]]";
                            break; 

                            case 2:
                            mystring = "[[audio controls]][[source src='files/{{$exercice->audio}}' type='audio/mpeg']]Your browser does not support the audio element.[[/audio]]"
                            break;
                        }
                        this.addToContent(mystring);
                    })
                    .catch((error) => {
                        console.log("error" + error);

                        this.ma_errors.push("Hubo un error al subir el archivo. Tamaño máximo: 8mb"); 
                    })             
                }
            },

            addToContent(mystring){
               this.html = this.editor.getHTML(); 
               this.$emit("updatedHtml", this.html); 


               this.editor.setContent(this.html + "<p>" + mystring + "</p>")
               console.log(mystring); 
               this.html = this.editor.getHTML(); 
               this.$emit("updatedHtml", this.html); 
//this.editor.onUpdate = ({ getJSON, getHTML }) => {
 // this.html = getHTML();
  //this.$emit("updatedHtml", this.html); 
//}
},

clearContent() {
    this.editor.clearContent(true);
    this.editor.focus()
},
setContent() {
                // you can pass a json document
                this.editor.setContent({
                    type: 'doc',
                    content: 
                    [{
                        type: 'paragraph',
                        content: 
                        [
                        {
                            type: 'text',
                            text: 'This is some inserted text. 👋',
                        },
                        ],
                    }],
                }, true)
                // HTML string is also supported
                // this.editor.setContent('<p>This is some inserted text. 👋</p>')
                this.editor.focus()
            }
        },

    }
</script>
