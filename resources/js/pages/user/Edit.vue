<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'UserEdit',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
        Input,
    },
    props: {
        user: {
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
                "name": this.user.name,
                "email": this.user.email,
                "role": this.user.role,
                'office_id': this.user.office_id || '',
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Users', href: route('users.index') },
                { title: 'Edit', href: route('users.edit', this.user.id) },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.put(route('users.update', this.user.id), {
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

    <Head title="Edit User" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Edit User</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="office">Office</label>
                    <select v-model="form.office_id" id="office"
                        class="mt-2 flex h-9 w-full rounded-xl border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
                        <option value="">Select Office</option>
                        <option v-for="office in offices" :key="office.id" :value="office.id">
                            {{ JSON.parse(office.office_name).bn }}, {{ JSON.parse(office.upazila).bn }}, {{
                                JSON.parse(office.district).bn }}
                        </option>
                    </select>
                    <div class="text-red-500 text-sm" v-if="form.errors.office_id">{{ form.errors.office_id }}</div>
                </div>
                <div>
                    <label for="user_name">Name</label>
                    <Input v-model="form.name" id="user_name" class="mt-2" type="text" placeholder="User Name" />
                    <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>

                <div>
                    <label for="user_email">Email</label>
                    <Input v-model="form.email" id="user_email" class="mt-2" type="email" placeholder="User Email" />
                    <div class="text-red-500 text-sm" v-if="form.errors.email">{{ form.errors.email }}</div>
                </div>
                <div>
                    <label for="user_role">Role</label>
                    <select v-model="form.role" id="user_role"
                        class="mt-2 flex h-9 w-full rounded-xl border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <div class="text-red-500 text-sm" v-if="form.errors.role">{{ form.errors.role }}</div>
                </div>
                <div class="form-group text-right">
                    <Button type="submit" :loading="loading">
                        <span v-if="loading">Updating</span>
                        <span v-else>Update</span>
                    </Button>
                    <Link :href="route('users.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
