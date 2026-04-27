<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Button from '@/components/ui/Button.vue';

export default {
    name: 'OfficeShow',
    components: {
        AppLayout,
        Head,
        Link,
        Button,
    },
    props: {
        office: Object
    },
    data() {
        return {
            breadcrumbs: [
                { title: 'Offices', href: route('offices.index') },
                { title: 'Create', href: route('offices.create') },
            ],
        };
    },
};
</script>

<template>

    <Head title="Show Office" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-5xl mx-auto p-6">

            <!-- Card -->
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

                <!-- Header -->
                <div class="bg-indigo-600 px-6 py-4">
                    <h1 class="text-xl font-semibold text-white">
                        Office Details
                    </h1>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-4">

                    <!-- Row -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 border-b pb-2">
                        <div class="text-gray-500">Office Name (Bangla)</div>
                        <div class="hidden md:block text-center">:</div>
                        <div b="font-medium text-gray-800 md:text-right">
                            {{ office.name_bn }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 border-b pb-2">
                        <div class="text-gray-500">Office Name (English)</div>
                        <div class="hidden md:block text-center">:</div>
                        <div class="font-medium text-gray-800 md:text-right">
                            {{ office.name_en }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 border-b pb-2">
                        <div class="text-gray-500">Ministry Name (Bangla)</div>
                        <div class="hidden md:block text-center">:</div>
                        <div class="font-medium text-gray-800 md:text-right">
                            {{ office.ministry_name?.bn }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 border-b pb-2">
                        <div class="text-gray-500">Ministry Name (English)</div>
                        <div class="hidden md:block text-center">:</div>
                        <div class="font-medium text-gray-800 md:text-right">
                            {{ office.ministry_name?.en }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 border-b pb-2">
                        <div class="text-gray-500">Ministry Code</div>
                        <div class="hidden md:block text-center">:</div>
                        <div class="font-medium md:text-right">
                            {{ office.ministry_code }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 border-b pb-2">
                        <div class="text-gray-500">Office Level Code</div>
                        <div class="hidden md:block text-center">:</div>
                        <div class="font-medium md:text-right">
                            {{ office.office_level_code }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 border-b pb-2">
                        <div class="text-gray-500">Geo Code</div>
                        <div class="hidden md:block text-center">:</div>
                        <div class="font-medium md:text-right">
                            {{ office.geo_code }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 border-b pb-2">
                        <div class="text-gray-500">DDO Code</div>
                        <div class="hidden md:block text-center">:</div>
                        <div class="font-medium md:text-right">
                            {{ office.ddo_code }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <div class="text-gray-500">Number of Sections</div>
                        <div class="hidden md:block text-center">:</div>
                        <div class="font-medium md:text-right">
                            {{ office.section }}
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3">
                    <Link :href="route('offices.index')">
                    <Button variant="secondary">Back</Button>
                    </Link>

                    <Link :href="route('offices.edit', office.id)">
                    <Button>Edit</Button>
                    </Link>
                </div>

            </div>

        </div>
    </AppLayout>
</template>
