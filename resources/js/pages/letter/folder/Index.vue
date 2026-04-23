<script>
import Button from '@/components/ui/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

export default {
    name: 'FolderIndex',
    components: { AppLayout, Head, Link, Button },
    props: {
        folders: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            breadcrumbs: [
                { title: 'Folders', href: route('folders.index') },
            ],
            loading: false,
            deleteingId: null,
        };
    },
    methods: {
        handleDelete(id) {
            if (confirm('Delete this folder?')) {
                this.loading = true;
                this.deleteingId = id;
                router.delete(route('folders.destroy', id), {
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
        getLang(obj, key) {
            if (!obj) return '';
            if (typeof obj === 'string') {
                try {
                    obj = JSON.parse(obj);
                } catch (e) { return ''; }
            }
            return obj[key] || '';
        },
    },
};
</script>

<template>

    <Head title="Folders" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Folders</h1>
                <Link :href="route('folders.create')"
                    class="inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">
                Add Folder</Link>
            </div>
            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            <th class="px-6 py-3 font-medium" scope="col">ID</th>
                            <th class="px-6 py-3 font-medium" scope="col">Folder Name</th>
                            <th class="px-6 py-3 font-medium" scope="col">Code</th>
                            <th class="px-6 py-3 font-medium text-right" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="folder in folders" :key="folder.id"
                            class="bg-neutral-primary border-b border-default">
                            <td class="px-6 py-4">{{ folder.id }}</td>
                            <td class="px-6 py-4">
                                {{ folder.name }}
                            </td>
                            <td>
                                {{ folder.code }}
                            </td>

                            <td class="text-right">
                                <Link :href="route('folders.edit', folder.id)"
                                    class="mr-1 inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">
                                <i class="fa fa-edit"></i>
                                </Link>
                                <Button @click="handleDelete(folder.id)" :disabled="loading" type="button">
                                    <span v-if="loading && folder.id === deleteingId">
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
