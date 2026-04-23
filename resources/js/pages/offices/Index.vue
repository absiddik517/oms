
<script>
import Button from '@/components/ui/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

export default {
    name: 'OfficesIndex',
    components: { AppLayout, Head, Link, Button },
    props: {
        offices: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            breadcrumbs: [
                { title: 'Offices', href: route('offices.index') },
            ],
            loading: false,
        };
    },
    methods: {
        handleDelete(id) {
            if (confirm('Delete this office?')) {
                this.loading = true;
                router.delete(route('offices.destroy', id), {
                    onSuccess: () => {
                        this.loading = false;
                    },

                    onError: (errors) => {
                        this.loading = false;
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
        <Head title="Offices" />
        <AppLayout :breadcrumbs="breadcrumbs">
            <div class="container mx-auto p-4">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Offices</h1>
                    <Link :href="route('offices.create')" class="inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">Add Office</Link>
                </div>
                <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                    <table class="w-full text-sm text-left rtl:text-right text-body">
                        <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                            <tr>
                                <th class="px-6 py-3 font-medium" scope="col">ID</th>
                                <th class="px-6 py-3 font-medium" scope="col">Office Name</th>
                                <th class="px-6 py-3 font-medium" scope="col">Upazila</th>
                                <th class="px-6 py-3 font-medium" scope="col">District</th>
                                <th class="px-6 py-3 font-medium" scope="col">Geo Code</th>
                                <th class="px-6 py-3 font-medium" scope="col">Office Code</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="office in offices" :key="office.id" class="bg-neutral-primary border-b border-default">
                                <td class="px-6 py-4">{{ office.id }}</td>
                                <td class="px-6 py-4">
                                    {{ getLang(office.office_name, 'bn') }} <br />
                                    {{ getLang(office.office_name, 'en') }}
                                </td>
                                <td>
                                    {{ getLang(office.upazila, 'en') }}<br/>
                                    {{ getLang(office.upazila, 'bn') }}
                                </td>
                                <td>
                                    {{ getLang(office.district, 'en') }}<br/>
                                    {{ getLang(office.district, 'bn') }}
                                </td>
                                <td>{{ office.geo_code }}</td>
                                <td>{{ office.office_code }}</td>
                                <td>
                                    <Link 
                                        :href="route('offices.edit', office.id)" 
                                        class="mr-1 inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white"
                                    >Edit
                                </Link>
                                    <Button :key="office.id" @click="handleDelete(office.id)" :disabled="loading" type="button">
                                        <span v-if="loading">Deleting...</span>
                                        <span v-else>Delete</span>
                                    </Button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </AppLayout>
</template>
