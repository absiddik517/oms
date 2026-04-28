<script>
import Button from '@/components/ui/Button.vue';
import Badge from '@/components/ui/Badge.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

export default {
    name: 'OfficerIndex',
    components: { AppLayout, Head, Link, Button, Badge },
    props: {
        officers: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            breadcrumbs: [
                { title: 'Officers', href: route('officers.index') },
            ],
            loading: false,
            deleteingId: null,
        };
    },
    methods: {
        handleDelete(id) {
            if (confirm('Delete this officer?')) {
                this.loading = true;
                this.deleteingId = id;
                router.delete(route('officers.destroy', id), {
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

    <Head title="Officers" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Officers</h1>
                <Link :href="route('officers.create')"
                    class="inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">
                Add Officer</Link>
            </div>
            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            <th class="px-6 py-3 font-medium" scope="col">ID</th>
                            <th class="px-6 py-3 font-medium" scope="col">Officer</th>
                            <th class="px-6 py-3 font-medium text-center" scope="col">Contact</th>
                            <th class="px-6 py-3 font-medium text-center" scope="col">Status</th>
                            <th class="px-6 py-3 font-medium text-right" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="officer in officers" :key="officer.id"
                            class="bg-neutral-primary border-b border-default">
                            <td class="px-6 py-4">{{ officer.id }}</td>
                            <td class="px-6 py-4">
                                {{ officer.name }} <br />
                                {{ officer.designation }} <br />
                                {{ officer.office.name_bn }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <p v-if="officer.email"><i class="fa fa-envelope"></i> {{ officer.email }}</p>
                                <p v-if="officer.phone"><i class="fa fa-phone"></i> {{ officer.phone }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <Badge :type="officer.status === 'active' ? 'success' : 'danger'">
                                    {{ officer.status }}
                                </Badge>
                            </td>

                            <td class="text-right">
                                <Link :href="route('officers.edit', officer.id)"
                                    class="mr-1 inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">
                                <i class="fa fa-edit"></i>
                                </Link>
                                <Button @click="handleDelete(officer.id)" :disabled="loading" type="button">
                                    <span v-if="loading && officer.id === deleteingId">
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
