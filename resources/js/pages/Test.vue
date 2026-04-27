<script setup>
import { ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

const form = useForm({
    subject: '',
    letter_number: '',
    letter_date: '',
    priority: 'normal',
    office_id: '',
    body: '',
    attachments: [
        {
            title: '',
            file: ''
        }
    ],
})

const handleSubmit = () => {
    form.post(route('letters.store'))
}

const breadcrumbs = [
    { title: 'Folders', href: route('folders.index') },
    { title: 'Create', href: route('folders.create') },
]

const handleAddAttachment = () => {
    form.attachments.push({
        title: '',
        file: ''
    })
}

const handleRemoveAttachment = (index) => {
    form.attachments.splice(index, 1)
}
</script>

<template>

    <Head title="Page" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="min-h-screen bg-gray-100 p-3">

            <form @submit.prevent="handleSubmit" class="space-y-6">

                <!-- Basic Info -->
                <div class="flex gap-2 w-full">
                    <div class="bg-white rounded-xl shadow p-6 space-y-4 w-4/6">

                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            Basic Information
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="text-sm text-gray-600">Letter Number <span
                                        class="text-red-600 text-xl">*</span></label>
                                <input v-model="form.letter_number" class="w-full border rounded-lg p-2 mt-1"
                                    type="text" />
                            </div>

                            <div>
                                <label class="text-sm text-gray-600">Date</label>
                                <input v-model="form.letter_date" class="w-full border rounded-lg p-2 mt-1"
                                    type="date" />
                            </div>

                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Subject</label>
                            <input v-model="form.subject" class="w-full border rounded-lg p-2 mt-1" type="text" />
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Priority</label>
                            <select v-model="form.priority" class="w-full border rounded-lg p-2 mt-1">
                                <option value="normal">Normal</option>
                                <option value="urgent">Urgent</option>
                                <option value="most_urgent">Most Urgent</option>
                            </select>
                        </div>

                    </div>
                    <div class="bg-white rounded-xl shadow p-6 space-y-4 w-2/6">

                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            Basic Information
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="text-sm text-gray-600">Letter Number</label>
                                <input v-model="form.letter_number" class="w-full border rounded-lg p-2 mt-1"
                                    type="text" />
                            </div>

                            <div>
                                <label class="text-sm text-gray-600">Date</label>
                                <input v-model="form.letter_date" class="w-full border rounded-lg p-2 mt-1"
                                    type="date" />
                            </div>

                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Subject</label>
                            <input v-model="form.subject" class="w-full border rounded-lg p-2 mt-1" type="text" />
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Priority</label>
                            <select v-model="form.priority" class="w-full border rounded-lg p-2 mt-1">
                                <option value="normal">Normal</option>
                                <option value="urgent">Urgent</option>
                                <option value="most_urgent">Most Urgent</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Office Section -->
                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
                        Office & Recipient
                    </h2>

                    <div class="mt-4">
                        <label class="text-sm text-gray-600">Office</label>
                        <select v-model="form.office_id" class="w-full border rounded-lg p-2 mt-1">
                            <option value="">Select Office</option>
                            <option value="1">Head Office</option>
                            <option value="2">Branch Office</option>
                        </select>
                    </div>

                </div>

                <!-- Body -->
                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
                        Letter Body
                    </h2>

                    <textarea v-model="form.body" rows="6" class="w-full border rounded-lg p-2 mt-3"
                        placeholder="Write your letter content..."></textarea>


                </div>

                <!-- Attachments -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex w-full justify-between border-b">
                        <h2 class="text-lg font-semibold text-gray-700  pb-2">
                            Attachments
                        </h2>
                        <button type="button" title="Add attachment" @click="handleAddAttachment()"
                            class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"><i
                                class="fa fa-plus"></i></button>
                    </div>

                    <div class="flex gap-4 mt-3 flex-wrap" v-for="(attachment, index) in form.attachments">
                        <div class="flex items-center xm:w-full">{{ index + 1 }}.</div>
                        <div class="flex-1 flex items-center">
                            <input class="w-full border p-2 rounded-lg" placeholder="Attachments title"
                                v-model="attachment.title" />
                        </div>
                        <div class="flex-1">
                            <input type="file" multiple class="w-full border p-2 rounded-lg"
                                @change="e => attachment.file = e.target.files" />
                        </div>
                        <div class="flex items-center" v-if="form.attachments.length > 1">
                            <button type="button" title="Remove attachment" @click="handleRemoveAttachment(index)"
                                class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 disabled:bg-red-300 disabled:cursor-not-allowed"><i
                                    class="fa fa-trash"></i></button>

                        </div>
                    </div>

                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3">

                    <button type="button" class="px-5 py-2 border rounded-lg hover:bg-gray-200">
                        Cancel
                    </button>

                    <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Submit
                    </button>

                </div>

            </form>

        </div>

    </AppLayout>
</template>