<template>
    <div class="border rounded p-2">

        <!-- Toolbar -->
        <div class="flex gap-2 mb-2 border-b pb-2 flex-wrap">

            <button type="button" @click="editor.chain().focus().toggleBold().run()"
                :class="{ active: editor?.isActive('bold') }">
                B
            </button>

            <button type="button" @click="editor.chain().focus().toggleItalic().run()"
                :class="{ active: editor?.isActive('italic') }">
                I
            </button>

            <button type="button" @click="editor.chain().focus().toggleUnderline().run()"
                :class="{ active: editor?.isActive('underline') }">
                U
            </button>

            <button type="button" @click="setLink">
                Link
            </button>

            <button type="button" @click="editor.chain().focus().toggleBulletList().run()">
                • List
            </button>

            <button type="button" @click="editor.chain().focus().toggleOrderedList().run()">
                1. List
            </button>

            <button type="button" @click="editor.chain().focus().unsetAllMarks().clearNodes().run()">
                Clear
            </button>

        </div>

        <!-- Editor -->
        <EditorContent :editor="editor" class="min-h-[120px] outline-none" />
    </div>
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import Link from '@tiptap/extension-link'

export default {
    name: 'RichText',

    components: {
        EditorContent,
    },

    props: {
        modelValue: String,
        placeholder: {
            type: String,
            default: 'Write something...',
        },
    },

    emits: ['update:modelValue'],

    data() {
        return {
            editor: null,
        }
    },

    mounted() {
        this.editor = new Editor({
            content: this.modelValue || '',
            extensions: [
                StarterKit,
                Underline,
                Link.configure({
                    openOnClick: false,
                }),
            ],
            editorProps: {
                attributes: {
                    class: 'min-h-[120px] focus:outline-none',
                },
            },
            onUpdate: ({ editor }) => {
                this.$emit('update:modelValue', editor.getHTML())
            },
        })
    },

    watch: {
        modelValue(value) {
            if (this.editor && value !== this.editor.getHTML()) {
                this.editor.commands.setContent(value || '')
            }
        },
    },

    beforeUnmount() {
        if (this.editor) {
            this.editor.destroy()
        }
    },

    methods: {
        setLink() {
            const url = prompt('Enter URL')

            if (!url) return

            this.editor.chain().focus().setLink({ href: url }).run()
        },
    },
}
</script>

<style scoped>
button {
    padding: 4px 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 12px;
}

button.active {
    background: black;
    color: white;
}
</style>