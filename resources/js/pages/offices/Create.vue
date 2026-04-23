<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';

export default {
    name: 'OfficeCreate',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
    },
    data() {
        return {
            form: useForm({
                "office_name": {
                    "bn": "উপজেলা উপানুষ্ঠানিক শিক্ষা ব্যুরো",
                    "en": "Upazila Non-Formal Education Bureau"
                },
                "upazila": {
                    "bn": "হালুয়াঘাট",
                    "en": "Haluaghat"
                },
                "district": {
                    "bn": "ময়মনসিংহ",
                    "en": "Mymensingh"
                },
                "geo_code": "6114",
                "office_code": "1240303142501",
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Offices', href: route('offices.index') },
                { title: 'Create', href: route('offices.create') },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.post(route('offices.store'), {
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
        <Head title="Add Office" />
        <AppLayout :breadcrumbs="breadcrumbs">
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4">Add Office</h1>
                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label>Office Name</label>
                        <LangInput v-model="form.office_name" :form="form.office_name" :languages="['bn', 'en']" placeholder="Enter office name" />
                        <div class="text-red-500 text-sm" v-if="form.errors['office_name.bn']">{{ form.errors['office_name.bn'] }}</div>
                        <div class="text-red-500 text-sm" v-if="form.errors['office_name.en']">{{ form.errors['office_name.en'] }}</div>
                    </div>
                    <div>
                        <label>Upazila</label>
                        <LangInput v-model="form.upazila" :form="form.upazila" :languages="['bn', 'en']" placeholder="Enter upazila" />
                        <div class="text-red-500 text-sm" v-if="form.errors['upazila.bn']">{{ form.errors['upazila.bn'] }}</div>
                        <div class="text-red-500 text-sm" v-if="form.errors['upazila.en']">{{ form.errors['upazila.en'] }}</div>
                    </div>
                    <div>
                        <label>District</label>
                        <LangInput v-model="form.district" :form="form.district" :languages="['bn', 'en']" placeholder="Enter district" />
                        <div class="text-red-500 text-sm" v-if="form.errors['district.bn']">{{ form.errors['district.bn'] }}</div>
                        <div class="text-red-500 text-sm" v-if="form.errors['district.en']">{{ form.errors['district.en'] }}</div>
                    </div>
                    <div>
                        <label>Geo Code</label>
                        <input v-model="form.geo_code" type="text" class="border p-2 w-full" />
                        <div class="text-red-500 text-sm" v-if="form.errors.geo_code">{{ form.errors.geo_code }}</div>
                    </div>
                    <div>
                        <label>Office Code</label>
                        <input v-model="form.office_code" type="text" class="border p-2 w-full" />
                        <div class="text-red-500 text-sm" v-if="form.errors.office_code">{{ form.errors.office_code }}</div>
                    </div>
                    <div class="form-group text-right">
                        <Button type="submit" :loading="loading">
                            <span v-if="loading">Creating</span>
                            <span v-else>Create</span>
                        </Button>
                        <Link :href="route('offices.index')" class="ml-2 text-gray-600">Cancel</Link>
                    </div>
                </form>
            </div>
        </AppLayout>
</template>
