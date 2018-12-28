<template>
    <div>

        <div class="ma-editor">
            <div class="ma-addFiles">
                <div class="ma-addFileButton"><a href=""><img src="images/icons/bt_img_off.jpg"/><img src="images/icons/bt_img_on.jpg"/></a></div>
                <div class="ma-addFileButton"><a href=""><img src="images/icons/bt_video_off.jpg"/><img src="images/icons/bt_video_on.jpg"/></a></div>
                <div class="ma-addFileButton"><a href=""><img src="images/icons/bt_audio_off.jpg"/><img src="images/icons/bt_audio_on.jpg"/></a></div>
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
                editor: new Editor({
                    content:  `
                    <h2>
                    Export HTML or JSON
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
