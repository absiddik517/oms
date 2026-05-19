<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'FolderEdit',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
        Input,
    },
    props: {
        folder: {
            type: Object,
            required: true,
        },
        offices: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            form: useForm({
                name: this.folder.name,
                description: this.folder.description,
                code: this.folder.code,
                'office_id': this.folder.office_id,
                creation_date: this.folder.creation_date,
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Folders', href: route('folders.index') },
                { title: 'Edit', href: route('folders.edit', this.folder.id) },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.put(route('folders.update', this.folder.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.loading = false;
                },
                onError: () => {
                    this.loading = false;
                },
            });
        },
    },
};
</script>

<template>

    <Head title="Edit Folder" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Edit Folder</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="office">Office</label>
                    <select v-model="form.office_id" id="office"
                        class="mt-2 flex h-9 w-full rounded-xl border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
                        <option value="">Select Office</option>
                        <option v-for="office in offices" :key="office.id" :value="office.id">
                            {{ office.office_name.bn }}, {{ office.upazila.bn }}, {{ office.district.bn }}
                        </option>
                    </select>
                    <div class="text-red-500 text-sm" v-if="form.errors.office_id">{{ form.errors.office_id }}</div>
                </div>
                <div>
                    <label for="folder_name">Name</label>
                    <Input v-model="form.name" id="folder_name" class="mt-2" type="text" placeholder="Folder Name" />
                    <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>

                <div>
                    <label for="folder_description">Description</label>
                    <Input v-model="form.description" id="folder_description" class="mt-2" type="text"
                        placeholder="Description" />
                    <div class="text-red-500 text-sm" v-if="form.errors.description">{{ form.errors.description }}</div>
                </div>
                <div>
                    <label for="folder_code">Code</label>
                    <Input v-model="form.code" class="mt-2" id="folder_code" placeholder="Folder Code" type="text" />
                    <div class="text-red-500 text-sm" v-if="form.errors.code">{{ form.errors.code }}</div>
                </div>
                <div>
                    <label for="folder_creation_date">Creation Date</label>
                    <Input v-model="form.creation_date" class="mt-2" id="folder_creation_date"
                        placeholder="Folder Creation_date" type="text" />
                    <div class="text-red-500 text-sm" v-if="form.errors.creation_date">{{ form.errors.creation_date }}
                    </div>
                </div>
                <div class="form-group text-right">
                    <Button type="submit" :loading="form.processing">
                        <span v-if="form.processing">Updating</span>
                        <span v-else>Update</span>
                    </Button>
                    <Link :href="route('folders.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
