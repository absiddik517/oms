
<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';

export default {
    name: 'OfficeEdit',
    components: { AppLayout, Head, Link, LangInput, Button },
    props: {
        office: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: useForm({
                office_name: { ...this.office.office_name },
                upazila: { ...this.office.upazila },
                district: { ...this.office.district },
                geo_code: this.office.geo_code,
                office_code: this.office.office_code,
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Offices', href: route('offices.index') },
                { title: 'Edit', href: route('offices.edit', this.office.id) },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.put(route('offices.update', this.office.id), {
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
        <Head title="Edit Office" />
        <AppLayout :breadcrumbs="breadcrumbs">
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4">Edit Office</h1>
                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label>Office Name</label>
                        <LangInput v-model="form.office_name" :form="form" :languages="['bn', 'en']" placeholder="Enter office name" />
                        <div class="text-red-500 text-sm" v-if="form.errors['office_name.bn']">{{ form.errors['office_name.bn'] }}</div>
                        <div class="text-red-500 text-sm" v-if="form.errors['office_name.en']">{{ form.errors['office_name.en'] }}</div>
                    </div>
                    <div>
                        <label>Upazila</label>
                        <LangInput v-model="form.upazila" :form="form" :languages="['bn', 'en']" placeholder="Enter upazila" />
                        <div class="text-red-500 text-sm" v-if="form.errors['upazila.bn']">{{ form.errors['upazila.bn'] }}</div>
                        <div class="text-red-500 text-sm" v-if="form.errors['upazila.en']">{{ form.errors['upazila.en'] }}</div>
                    </div>
                    <div>
                        <label>District</label>
                        <LangInput v-model="form.district" :form="form" :languages="['bn', 'en']" placeholder="Enter district" />
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
                        <Button type="submit" :loading="loading">Update</Button>
                        <Link :href="route('offices.index')" class="ml-2 text-gray-600">Cancel</Link>
                    </div>
                </form>
            </div>
        </AppLayout>
</template>
