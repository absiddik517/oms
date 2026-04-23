<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'SubjectEdit',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
        Input,
    },
    props: {
        subject: {
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
                "office_id": this.subject.office_id,
                "name": this.subject.name,
                "code": this.subject.code,

            }),
            loading: false,
            breadcrumbs: [
                { title: 'Subjects', href: route('subject.index') },
                { title: 'Edit', href: route('subject.edit', this.subject.id) },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.put(route('subject.update', this.subject.id), {
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

    <Head title="Edit Subject" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Edit Subject</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="subject_name">Subject Name</label>
                    <Input v-model="form.name" id="subject_name" class="mt-2" type="text" placeholder="Subject Name" />
                    <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div>
                    <label for="subject_code">Subject Code</label>
                    <Input v-model="form.code" id="subject_code" class="mt-2" type="text" placeholder="Subject Code" />
                    <div class="text-red-500 text-sm" v-if="form.errors.code">{{ form.errors.code }}</div>
                </div>
                <div class="form-group text-right">
                    <Button type="submit" :loading="loading">
                        <span v-if="loading">Updating...</span>
                        <span v-else>Update</span>
                    </Button>
                    <Link :href="route('subject.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
