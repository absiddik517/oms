<script>
import Button from '@/components/ui/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

export default {
    name: 'RecipientsIndex',
    components: { AppLayout, Head, Link, Button },
    props: {
        recipients: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            breadcrumbs: [
                { title: 'Recipients', href: route('recipients.index') },
            ],
            loading: false,
            deleteingId: null,
        };
    },
    methods: {
        handleDelete(id) {
            if (confirm('Delete this recipient?')) {
                this.loading = true;
                this.deleteingId = id;
                router.delete(route('recipients.destroy', id), {
                    onSuccess: () => {
                        this.loading = false;
                        this.deleteingId = null;
                    },

                    onError: (errors) => {
                        this.loading = false;
                        this.deleteingId = null;
                    }
                })
            }
        },

    },
};
</script>

<template>

    <Head title="Recipients" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Recipients</h1>
                <Link :href="route('recipients.create')"
                    class="inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">
                Add Recipient</Link>
            </div>
            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            <th class="px-6 py-3 font-medium" scope="col">ID</th>
                            <th class="px-6 py-3 font-medium" scope="col">Recipient</th>
                            <th class="px-6 py-3 font-medium text-right" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="recipient in recipients" :key="recipient.id"
                            class="bg-neutral-primary border-b border-default">
                            <td class="px-6 py-4">{{ recipient.id }}</td>
                            <td class="px-6 py-4">
                                {{ recipient.name }} <br v-if="recipient.name" />
                                {{ recipient.designation }} <br v-if="recipient.designation" />
                                {{ recipient.organization }}, {{ recipient.address }} <br
                                    v-if="recipient.organization || recipient.address" />

                                {{ recipient.email }} <br v-if="recipient.email" />
                                {{ recipient.phone }}
                            </td>

                            <td class="text-right">
                                <Link :href="route('recipients.edit', recipient.id)"
                                    class="mr-1 inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">
                                <i class="fa fa-edit"></i>
                                </Link>
                                <Button @click="handleDelete(recipient.id)" :disabled="loading" type="button">
                                    <span v-if="loading && recipient.id === deleteingId">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </span>
                                    <span v-else>
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
