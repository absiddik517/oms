<!-- resources/js/Pages/Post/Create.vue -->
<template>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Create Post</h1>

        <form @submit.prevent="submit">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Title</label>
                <input v-model="form.title" type="text" class="w-full border rounded px-3 py-2"
                    placeholder="Post title" />
                <span v-if="form.errors.title" class="text-red-500 text-sm">
                    {{ form.errors.title }}
                </span>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Content</label>
                <JoditEditor v-model="form.content" :config="editorConfig" />
                <span v-if="form.errors.content" class="text-red-500 text-sm">
                    {{ form.errors.content }}
                </span>
            </div>

            <button type="submit" :disabled="form.processing"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Save Post
            </button>
        </form>

        <pre>{{ form }}</pre>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import JoditEditor from '../components/ui/form/JoditEditor.vue'

const form = useForm({
    title: '',
    content: ''
})

const editorConfig = {
    height: 500,
    placeholder: 'Start writing your content...'
}

const submit = () => {

}
</script>