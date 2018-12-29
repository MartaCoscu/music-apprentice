<template>
    <div>

        <div class="ma-editor">
         <div class="ma-error" v-for="error in errors">
            {{ error }}
        </div>
            <div class="ma-addFiles">
                <input id="inputImg" v-on:change="onFileChange" accept=".jpg,.png" type="file" style="display: none" />
                <div class="ma-addFileButton"><a v-on:click.prevent="onUploadImg" href=""><img src="images/icons/bt_img_off.jpg"/><img src="images/icons/bt_img_on.jpg"/></a></div>

                <input id="inputVideo" v-on:change="onFileChange" type="file" accept=".mp4" style="display: none" />
                <div class="ma-addFileButton"><a v-on:click.prevent="onUploadVideo" href=""><img src="images/icons/bt_video_off.jpg"/><img src="images/icons/bt_video_on.jpg"/></a></div>

                <input id="inputAudio" v-on:change="onFileChange" type="file" accept=".mp3,.wav" style="display: none" />
                <div class="ma-addFileButton"><a href="" v-on:click.prevent="onUploadAudio"><img src="images/icons/bt_audio_off.jpg"/><img src="images/icons/bt_audio_on.jpg"/></a></div>
                <div class="ma-addFileButton"><img src="images/icons/bt_file_off.jpg"/></div>
            </div>
            <editor-content :editor="editor" />
        </div>

    </div>
</template>

<script>
    import { Editor, EditorContent } from 'tiptap'
    export default {
        components: {
            EditorContent,
        },
        data() {
            return {
                file: '',
                errors: [
                ],
                editor: new Editor({
                    content:  `
                    <h2>
                    Export HTML or JSON2
                    </h2>
                    <p>
                    You are able to export your data as <code>HTML</code> or <code>JSON</code>. To pass <code>HTML</code> to the editor use the <code>content</code> slot. To pass <code>JSON</code> to the editor use the <code>doc</code> prop.
                    </p>
                    `,

                    onUpdate: ({ getJSON, getHTML }) => {
                      this.html = getHTML()
                      this.$emit("updatedHtml", this.html); 
                  },
              }),
                html: ''
            }
        },

        mounted() {
            console.log('Component mounted.')
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


            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                return;
            //    this.createImage(files[0]);
                this.file = files[0]; 
                let formData = new FormData();
                formData.append('file', this.file);
                    axios.post('/upload',formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                    .then((response) => {
                        console.log(response); 
                    })
                    .catch((error) => {
                        errors.push("Hubo un error al subir el archivo. Tamaño máximo: 8mb"); 
                        console.log("error" + error)
                    })
            },


            clearContent() {
                this.editor.clearContent(true)
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
        }
    }
</script>
