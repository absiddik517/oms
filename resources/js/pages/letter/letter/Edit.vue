<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Input from '@/components/ui/form/Input.vue';
import Button from '@/components/ui/Button.vue';
import JoditEditor from '@/components/ui/form/JoditEditor.vue';

export default {
    name: 'LetterEdit',

    components: {
        AppLayout,
        Head,
        Link,
        Input,
        Button,
        JoditEditor,
    },

    props: {
        offices: Array,
        officers: Array,
        topics: Array,
        folders: Array,
        recipients: Array,
        letter: Object,
    },

    data() {
        return {
            existingAttachments: this.letter.attachments || [],

            form: useForm({
                office_id: this.letter.office_id || '',
                officer_id: this.letter.officer_id || '',
                topic_id: this.letter.topic_id || '',
                folder_id: this.letter.folder_id || '',
                letter_number: this.letter.letter_number || '',
                subject: this.letter.subject || '',
                body: this.letter.body || '',
                letter_date: this.letter.letter_date || '',
                status: this.letter.status,

                // recipients
                to: this.letter.recipients?.find(r => r.pivot.type === 'to')?.id ?? '',
                cc: this.letter.recipients?.filter(r => r.pivot.type === 'cc').map(r => r.id) || [],

                // attachments
                attachments: [],
                deleted_attachments: [],
            }),

            editorConfig: {
                height: 500,
                placeholder: 'Start writing your content...'
            },

            loading: false,

            breadcrumbs: [
                { title: 'Letters', href: route('letters.index') },
                { title: 'Edit', href: route('letters.edit', this.letter.id) },
            ],
        };
    },

    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();

            this.form.post(route('letters.update', this.letter.id), {
                forceFormData: true,
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

        removeAttachment(id) {
            this.existingAttachments = this.existingAttachments.filter(f => f.id !== id);
            this.form.deleted_attachments.push(id);
        },

        getOfficeName(office) {
            try {
                return JSON.parse(office.office_name).bn;
            } catch {
                return '';
            }
        }
    },
};
</script>

<template>

    <Head title="Edit Letter" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Edit Letter</h1>

            <form @submit.prevent="submit" class="space-y-4">

                <!-- OFFICE -->
                <div>
                    <label>Office</label>
                    <select v-model="form.office_id" class="input">
                        <option value="">Select Office</option>
                        <option v-for="office in offices" :key="office.id" :value="office.id">
                            {{ office.name_bn }}
                        </option>
                    </select>
                    <div class="text-red-500 text-sm">{{ form.errors.office_id }}</div>
                </div>
                <!--Officer-->
                <div>
                    <label>Officer</label>
                    <select v-model="form.officer_id" class="input">
                        <option value="">Select Officer</option>
                        <option v-for="officer in officers" :key="officer.id" :value="officer.id">
                            {{ officer.name }}
                        </option>
                    </select>
                    <div class="text-red-500 text-sm">{{ form.errors.officer_id }}</div>
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
                    <Input v-model="form.subject" />
                </div>

                <!-- BODY -->
                <div>
                    <label>Body</label>
                    <JoditEditor v-model="form.body" :config="editorConfig" />
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
                        <option value="completed">Completed</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>

                <!-- TO -->
                <div>
                    <label>To</label>
                    <select v-model="form.to" class="input">
                        <option value="">Select Receiver</option>
                        <option v-for="r in recipients" :key="r.id" :value="r.id">
                            {{ r.name }} {{ r.designation }} ({{ r.organization }}<span v-if="r.organization">,</span>
                            {{ r.address }})
                        </option>
                    </select>
                    <div class="text-red-500 text-sm">{{ form.errors.to }}</div>
                </div>

                <!-- CC -->
                <div>
                    <label>CC</label>
                    <select v-model="form.cc" multiple class="input h-32">
                        <option v-for="r in recipients" :key="r.id" :value="r.id">
                            {{ r.name }} {{ r.designation }} ({{ r.organization }}<span v-if="r.organization">,</span>
                            {{ r.address }})
                        </option>
                    </select>
                </div>

                <!-- EXISTING ATTACHMENTS -->
                <div v-if="existingAttachments.length">
                    <p class="font-semibold">Existing Attachments:</p>

                    <div v-for="file in existingAttachments" :key="file.id" class="flex gap-2 items-center">
                        <a :href="`/storage/${file.file_path}`" target="_blank" class="text-blue-600">
                            {{ file.file_name }}
                        </a>

                        <button type="button" @click="removeAttachment(file.id)" class="text-red-500 text-sm">
                            Remove
                        </button>
                    </div>
                </div>

                <!-- NEW ATTACHMENTS -->
                <div>
                    <label>Add New Attachments</label>
                    <input type="file" multiple @change="handleFileChange" />
                    <div class="text-red-500 text-sm">{{ form.errors.attachments }}</div>
                </div>

                <!-- BUTTON -->
                <div class="text-right">
                    <Button type="submit" :loading="form.processing">
                        <span v-if="form.processing">Saving...</span>
                        <span v-else>Update Letter</span>
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