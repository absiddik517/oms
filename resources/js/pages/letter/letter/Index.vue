<script>
import Button from '@/components/ui/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

export default {
    name: 'LetterIndex',
    components: { AppLayout, Head, Link, Button },
    props: {
        letters: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            breadcrumbs: [
                { title: 'Letters', href: route('letters.index') },
            ],
            loading: false,
            deleteingId: null,
        };
    },
    methods: {
        handleDelete(id) {
            if (confirm('Delete this letter?')) {
                this.loading = true;
                this.deleteingId = id;
                router.delete(route('letters.destroy', id), {
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

    <Head title="Letters" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Letters</h1>
                <Link :href="route('letters.create')"
                    class="inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">
                Add Letter</Link>
            </div>
            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            <th class="px-6 py-3 font-medium" scope="col">ID</th>
                            <th class="px-6 py-3 font-medium" scope="col">Letter Number</th>
                            <th class="px-6 py-3 font-medium" scope="col">Subject</th>
                            <th class="px-6 py-3 font-medium" scope="col">Date</th>
                            <th class="px-6 py-3 font-medium text-right" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="letter in letters" :key="letter.id"
                            class="bg-neutral-primary border-b border-default">
                            <td class="px-6 py-4">{{ letter.id }}</td>
                            <td class="px-6 py-4">
                                {{ letter.letter_number }}
                            </td>
                            <td>
                                {{ letter.subject }}
                            </td>
                            <td>
                                {{ letter.letter_date }}
                            </td>

                            <td class="text-right">
                                <Link :href="route('letters.edit', letter.id)"
                                    class="mr-1 inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">
                                <i class="fa fa-edit"></i>
                                </Link>
                                <Button @click="handleDelete(letter.id)" :disabled="loading" type="button">
                                    <span v-if="loading && letter.id === deleteingId">
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
