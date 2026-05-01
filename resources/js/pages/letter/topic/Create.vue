<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'TopicCreate',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
        Input,
    },
    props: {
        offices: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            form: useForm({
                'office_id': this.$page.props.auth.user.office_id,
                'name': null,
                'code': null,
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Topics', href: route('topics.index') },
                { title: 'Create', href: route('topics.create') },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.post(route('topics.store'), {
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

    <Head title="Add Topic" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Add Topic</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div v-if="$page.props.auth.user.role === 'admin'">
                    <label for="office_id">Office</label>
                    <select v-model="form.office_id" id="office_id"
                        class="flex h-9 w-full rounded-xl border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
                        <option value="">Select Office</option>
                        <option v-for="office in offices" :value="office.id" :key="office.id">
                            {{ office.name_bn }}
                        </option>
                    </select>
                    <div class="text-red-500 text-sm" v-if="form.errors.office_id">{{ form.errors.office_id }}</div>
                </div>
                <div>
                    <label for="name">Name</label>
                    <Input v-model="form.name" id="name" class="mt-2" type="text" placeholder="Name" />
                    <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div>
                    <label for="code">Code</label>
                    <Input v-model="form.code" class="mt-2" id="code" placeholder="Code" type="text" />
                    <div class="text-red-500 text-sm" v-if="form.errors.code">{{ form.errors.code }}</div>
                </div>
                <div class="form-group text-right">
                    <Button type="submit" :loading="loading">
                        <span v-if="loading">Creating</span>
                        <span v-else>Create</span>
                    </Button>
                    <Link :href="route('topics.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
