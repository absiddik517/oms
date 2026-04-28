<script setup>
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import Button from '@/components/ui/Button.vue'

const props = defineProps({
    office: Object
})

const activeTab = ref('general')

const tabs = [
    { key: 'general', label: 'General' },
    { key: 'codes', label: 'Codes' },
    { key: 'meta', label: 'Meta' },
]

const breadcrumbs = [
    { title: 'Offices', href: route('offices.index') },
    { title: 'Show', href: '#' },
]
</script>

<template>

    <Head title="Office Details" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="max-w-5xl w-full mx-auto p-6" v-if="office">

            <!-- Card -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg overflow-hidden">

                <!-- Header -->
                <div class="px-6 py-5 border-b dark:border-gray-700 flex justify-between items-center">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                            {{ office?.name_en || 'Office' }}
                        </h1>
                        <p class="text-sm text-gray-500">
                            {{ office?.name_bn }}
                        </p>
                    </div>

                    <button onclick="window.print()"
                        class="px-3 py-1 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Print
                    </button>
                </div>

                <!-- Tabs -->
                <div class="flex gap-2 px-6 pt-4">
                    <button v-for="tab in tabs" :key="tab.key" @click="activeTab = tab.key" :class="[
                        'px-4 py-2 rounded-lg text-sm font-medium transition',
                        activeTab === tab.key
                            ? 'bg-indigo-600 text-white'
                            : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300'
                    ]">
                        {{ tab.label }}
                    </button>
                </div>

                <!-- Content -->
                <div class="p-6 min-h-[360px] transition-all duration-200">

                    <!-- GENERAL -->
                    <div v-show="activeTab === 'general'" class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Office Name (Bangla)</p>
                            <p class="font-semibold">{{ office?.name_bn || '-' }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Office Name (English)</p>
                            <p class="font-semibold">{{ office?.name_en || '-' }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Ministry (Bangla)</p>
                            <p class="font-semibold">{{ office?.ministry_name?.bn || '-' }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Ministry (English)</p>
                            <p class="font-semibold">{{ office?.ministry_name?.en || '-' }}</p>
                        </div>

                    </div>

                    <!-- CODES -->
                    <div v-show="activeTab === 'codes'" class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Ministry Code</p>
                            <p class="font-semibold">{{ office?.ministry_code }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Office Level Code</p>
                            <p class="font-semibold">{{ office?.office_level_code }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Geo Code</p>
                            <p class="font-semibold">{{ office?.geo_code }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">DDO Code</p>
                            <p class="font-semibold">{{ office?.ddo_code }}</p>
                        </div>

                    </div>

                    <!-- META -->
                    <div v-show="activeTab === 'meta'" class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Sections</p>
                            <p class="font-semibold">{{ office?.section }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Created At</p>
                            <p class="font-semibold">{{ office?.created_at }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                            <p class="text-xs text-gray-500">Updated At</p>
                            <p class="font-semibold">{{ office?.updated_at }}</p>
                        </div>

                        <!-- 👇 Invisible placeholder to keep layout same -->
                        <div class="invisible"></div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 flex justify-end gap-3 no-print">
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