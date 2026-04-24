<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Input from '@/components/ui/form/Input.vue';
import Button from '@/components/ui/Button.vue';
import RichText from '@/components/ui/form/RichText.vue';

export default {
    name: 'LetterCreate',
    components: {
        AppLayout,
        Head,
        Link,
        Input,
        Button,
        RichText,
    },
    props: {
        offices: Array,
        topics: Array,
        folders: Array,
        recipients: Array,
    },
    data() {
        return {
            form: useForm({
                office_id: '',
                topic_id: '',
                folder_id: '',
                letter_number: '',
                subject: '',
                body: '',
                letter_date: '',
                status: 'draft',

                // recipients
                to: '',
                cc: [],

                // attachments
                attachments: [],
            }),

            loading: false,

            breadcrumbs: [
                { title: 'Letters', href: route('letters.index') },
                { title: 'Create', href: route('letters.create') },
            ],
        };
    },

    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();

            this.form.post(route('letters.store'), {
                forceFormData: true, // important for files
                preserveScroll: true,

                onSuccess: () => {
                    this.loading = false;
                },

                onError: () => {
                    this.loading = false;
                },
            });
        },

        handleFileChange(e) {
            this.form.attachments = Array.from(e.target.files);
        },
    },
};
</script>

<template>

    <Head title="Create Letter" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Create Letter</h1>

            <form @submit.prevent="submit" class="space-y-4">

                <!-- OFFICE -->
                <div>
                    <label>Office</label>
                    <select v-model="form.office_id" class="input">
                        <option value="">Select Office</option>
                        <option v-for="office in offices" :key="office.id" :value="office.id">
                            {{ JSON.parse(office.office_name).bn }}
                        </option>
                    </select>
                    <div class="text-red-500 text-sm">{{ form.errors.office_id }}</div>
                </div>

                <!-- TOPIC -->
                <div>
                    <label>Topic</label>
                    <select v-model="form.topic_id" class="input">
                        <option value="">Select Topic</option>
                        <option v-for="topic in topics" :key="topic.id" :value="topic.id">
                            {{ topic.name }}
                        </option>
                    </select>
                </div>

                <!-- FOLDER -->
                <div>
                    <label>Folder</label>
                    <select v-model="form.folder_id" class="input">
                        <option value="">Select Folder</option>
                        <option v-for="folder in folders" :key="folder.id" :value="folder.id">
                            {{ folder.name }}
                        </option>
                    </select>
                </div>

                <!-- LETTER NUMBER -->
                <div>
                    <label>Letter Number</label>
                    <Input v-model="form.letter_number" />
                </div>

                <!-- SUBJECT -->
                <div>
                    <label>Subject</label>
                    <RichText v-model="form.subject" />
                </div>

                <!-- BODY -->
                <div>
                    <label>Body</label>
                    <textarea v-model="form.body" class="input h-32"></textarea>
                </div>

                <!-- DATE -->
                <div>
                    <label>Letter Date</label>
                    <Input type="date" v-model="form.letter_date" />
                </div>

                <!-- STATUS -->
                <div>
                    <label>Status</label>
                    <select v-model="form.status" class="input">
                        <option value="draft">Draft</option>
                        <option value="sent">Sent</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>

                <!-- TO (single receiver) -->
                <div>
                    <label>To</label>
                    <select v-model="form.to" class="input">
                        <option value="">Select Receiver</option>
                        <option v-for="r in recipients" :key="r.id" :value="r.id">
                            {{ r.name }}
                        </option>
                    </select>
                    <div class="text-red-500 text-sm">{{ form.errors.to }}</div>
                </div>

                <!-- CC (multiple) -->
                <div>
                    <label>CC</label>
                    <select v-model="form.cc" multiple class="input h-32">
                        <option v-for="r in recipients" :key="r.id" :value="r.id">
                            {{ r.name }}
                        </option>
                    </select>
                </div>

                <!-- ATTACHMENTS -->
                <div>
                    <label>Attachments</label>
                    <input type="file" multiple @change="handleFileChange" />
                    <div class="text-red-500 text-sm">{{ form.errors.attachments }}</div>
                </div>

                <!-- BUTTON -->
                <div class="text-right">
                    <Button type="submit" :loading="loading">
                        <span v-if="loading">Saving...</span>
                        <span v-else>Create Letter</span>
                    </Button>

                    <Link :href="route('letters.index')" class="ml-2 text-gray-600">
                    Cancel
                    </Link>
                </div>

            </form>
        </div>
    </AppLayout>
</template>

<style>
.input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
}
</style>