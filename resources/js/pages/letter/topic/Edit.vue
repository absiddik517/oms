<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'TopicEdit',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
        Input,
    },
    props: {
        topic: {
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
                "office_id": this.topic.office_id,
                "name": this.topic.name,
                "code": this.topic.code,

            }),
            loading: false,
            breadcrumbs: [
                { title: 'Topics', href: route('topics.index') },
                { title: 'Edit', href: route('topics.edit', this.topic.id) },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.put(route('topics.update', this.topic.id), {
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
                    <label for="topic_name">Topic Name</label>
                    <Input v-model="form.name" id="topic_name" class="mt-2" type="text" placeholder="Topic Name" />
                    <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div>
                    <label for="topic_code">Topic Code</label>
                    <Input v-model="form.code" id="topic_code" class="mt-2" type="text" placeholder="Topic Code" />
                    <div class="text-red-500 text-sm" v-if="form.errors.code">{{ form.errors.code }}</div>
                </div>
                <div class="form-group text-right">
                    <Button type="submit" :loading="loading">
                        <span v-if="loading">Updating...</span>
                        <span v-else>Update</span>
                    </Button>
                    <Link :href="route('topics.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
