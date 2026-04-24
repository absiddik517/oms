<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'RecipientEdit',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
        Input,
    },
    props: {
        recipient: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: useForm({
                "name": this.recipient.name,
                "designation": this.recipient.designation,
                "organization": this.recipient.organization,
                "address": this.recipient.address,
                "email": this.recipient.email,
                "phone": this.recipient.phone,
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Recipients', href: route('recipients.index') },
                { title: 'Edit', href: route('recipients.edit', this.recipient.id) },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.put(route('recipients.update', this.recipient.id), {
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

    <Head title="Edit Recipient" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Edit Recipient</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="name">Name</label>
                    <Input v-model="form.name" id="name" class="mt-2" type="text" placeholder="Name" />
                    <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div>
                    <label for="designation">Designation</label>
                    <Input v-model="form.designation" id="designation" class="mt-2" type="text"
                        placeholder="Designation" />
                    <div class="text-red-500 text-sm" v-if="form.errors.designation">{{ form.errors.designation }}</div>
                </div>
                <div>
                    <label for="organization">Organization</label>
                    <Input v-model="form.organization" id="organization" class="mt-2" type="text"
                        placeholder="Organization" />
                    <div class="text-red-500 text-sm" v-if="form.errors.organization">{{ form.errors.organization }}
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
                    <div class="text-red-500 text-sm" v-if]="form.errors.email">{{ form.errors.email }}</div>
                </div>
                <div>
                    <label for="phone">Phone</label>
                    <Input v-model="form.phone" id="phone" class="mt-2" type="text" placeholder="Phone" />
                    <div class="text-red-500 text-sm" v-if="form.errors.phone">{{ form.errors.phone }}</div>
                </div>
                <div class="form-group text-right">
                    <Button type="submit" :loading="loading">
                        <span v-if="loading">Updating...</span>
                        <span v-else>Update</span>
                    </Button>
                    <Link :href="route('recipients.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
