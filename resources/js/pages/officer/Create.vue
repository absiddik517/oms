<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'OfficerCreate',
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
                'office_id': '',
                'name': null,
                'designation': null,
                'category': 'regular',
                'address': null,
                'email': null,
                'phone': null,
                'joining_date': null,
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Officers', href: route('officers.index') },
                { title: 'Create', href: route('officers.create') },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.post(route('officers.store'), {
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

    <Head title="Add Officer" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Add Officer</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="office_id">Office</label>
                    <select v-model="form.office_id" id="office_id"
                        class="flex h-9 w-full rounded-xl border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
                        <option value="" disabled>Select Office</option>
                        <option v-for="office in offices" :key="office.id" :value="office.id">
                            {{ JSON.parse(office.office_name).bn }}, {{ JSON.parse(office.upazila).bn }}, {{
                                JSON.parse(office.district).bn }}
                        </option>
                    </select>
                    <div class="text-red-500 text-sm" v-if="form.errors.office_id">{{ form.errors.office_id }}</div>
                </div>
                <div>
                    <label for="name">Name</label>
                    <Input v-model="form.name" id="name" class="mt-2" type="text" placeholder="Name" />
                    <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div class="flex gap-2">
                    <div class="flex-1">
                        <label for="designation">Designation</label>
                        <Input v-model="form.designation" id="designation" class="mt-2" type="text"
                            placeholder="Designation" />
                        <div class="text-red-500 text-sm" v-if="form.errors.designation">{{ form.errors.designation }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="category">&nbsp;</label>
                        <select v-model="form.category" id="category"
                            class="mt-2 flex h-9 w-full rounded-xl border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
                            <option value="regular">Regular</option>
                            <option value="additional change">Additional Change</option>
                            <option value="current change">Current Change</option>
                        </select>
                        <div class="text-red-500 text-sm" v-if="form.errors.category">{{ form.errors.category }}</div>
                    </div>
                </div>
                <div>
                    <label for="address">Address</label>
                    <Input v-model="form.address" id="address" class="mt-2" type="text" placeholder="Address" />
                    <div class="text-red-500 text-sm" v-if="form.errors.address">{{ form.errors.address }}</div>
                </div>
                <div>
                    <label for="email">Email</label>
                    <Input v-model="form.email" id="email" class="mt-2" type="email" placeholder="Email" />
                    <div class="text-red-500 text-sm" v-if="form.errors.email">{{ form.errors.email }}</div>
                </div>
                <div>
                    <label for="phone">Phone</label>
                    <Input v-model="form.phone" id="phone" class="mt-2" type="text" placeholder="Phone" />
                    <div class="text-red-500 text-sm" v-if="form.errors.phone">{{ form.errors.phone }}</div>
                </div>

                <div class="form-group text-right">
                    <Button type="submit" :loading="loading">
                        <span v-if="loading">Creating</span>
                        <span v-else>Create</span>
                    </Button>
                    <Link :href="route('officers.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
