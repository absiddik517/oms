<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';

export default {
    name: 'OfficeEdit',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
    },
    props: {
        office: Object
    },
    data() {
        return {
            form: useForm({
                id: this.office.id,
                ministry_name: {
                    'bn': this.office.ministry_name.bn,
                    'en': this.office.ministry_name.en
                },
                "office_name": {
                    "bn": this.office.office_name.bn,
                    "en": this.office.office_name.en
                },
                "upazila": {
                    "bn": this.office.upazila.bn,
                    "en": this.office.upazila.en
                },
                "district": {
                    "bn": this.office.district.bn,
                    "en": this.office.district.en
                },
                "geo_code": this.office.geo_code,
                "ddo_code": this.office.ddo_code,
                "ministry_code": this.office.ministry_code,
                "office_level_code": this.office.office_level_code,
                "section": this.office.section
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Offices', href: route('offices.index') },
                { title: 'Edit', href: route('offices.index') },
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

    <Head title="Add Office" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4 bg-gray-50">
            <h1 class="text-2xl font-bold mb-4">Update Office</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="bg-white rounded-xl shadow p-6 space-y-4 w-full md:w-1/2">
                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            Basic Information
                        </h2>
                        <div>
                            <label>Ministry Name</label>
                            <LangInput v-model="form.ministry_name" :form="form.ministry_name" :languages="['bn', 'en']"
                                placeholder="Enter office name" />
                            <div class="text-red-500 text-sm" v-if="form.errors['ministry_name.bn']">{{
                                form.errors['ministry_name.bn'] }}</div>
                            <div class="text-red-500 text-sm" v-if="form.errors['ministry_name.en']">{{
                                form.errors['ministry_name.en'] }}</div>
                        </div>
                        <div>
                            <label>Office Name</label>
                            <LangInput v-model="form.office_name" :form="form.office_name" :languages="['bn', 'en']"
                                placeholder="Enter office name" />
                            <div class="text-red-500 text-sm" v-if="form.errors['office_name.bn']">{{
                                form.errors['office_name.bn'] }}</div>
                            <div class="text-red-500 text-sm" v-if="form.errors['office_name.en']">{{
                                form.errors['office_name.en'] }}</div>
                        </div>

                        <div>
                            <label>Upazila</label>
                            <LangInput v-model="form.upazila" :form="form.upazila" :languages="['bn', 'en']"
                                placeholder="Enter upazila" />
                            <div class="text-red-500 text-sm" v-if="form.errors['upazila.bn']">{{
                                form.errors['upazila.bn'] }}
                            </div>
                            <div class="text-red-500 text-sm" v-if="form.errors['upazila.en']">{{
                                form.errors['upazila.en'] }}
                            </div>
                        </div>
                        <div>
                            <label>District</label>
                            <LangInput v-model="form.district" :form="form.district" :languages="['bn', 'en']"
                                placeholder="Enter district" />
                            <div class="text-red-500 text-sm" v-if="form.errors['district.bn']">{{
                                form.errors['district.bn'] }}
                            </div>
                            <div class="text-red-500 text-sm" v-if="form.errors['district.en']">{{
                                form.errors['district.en'] }}
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow p-6 space-y-4 w-full md:w-1/2">
                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            Essential Information
                        </h2>

                        <div class="flex flex-col md:flex-row gap-2">
                            <div>
                                <label>Ministry Code</label>
                                <input v-model="form.ministry_code" type="text" class="border p-2 w-full" />
                                <div class="text-red-500 text-sm" v-if="form.errors.ministry_code">{{
                                    form.errors.ministry_code
                                    }}</div>
                            </div>
                            <div>
                                <label>Office Level Code</label>
                                <input v-model="form.office_level_code" type="text" class="border p-2 w-full" />
                                <div class="text-red-500 text-sm" v-if="form.errors.office_level_code">{{
                                    form.errors.office_level_code
                                    }}</div>
                            </div>
                        </div>




                        <div>
                            <label>Geo Code</label>
                            <input v-model="form.geo_code" type="text" class="border p-2 w-full" />
                            <div class="text-red-500 text-sm" v-if="form.errors.geo_code">{{ form.errors.geo_code }}
                            </div>
                        </div>
                        <div>
                            <label>DDO Code</label>
                            <input v-model="form.ddo_code" type="text" class="border p-2 w-full" />
                            <div class="text-red-500 text-sm" v-if="form.errors.ddo_code">{{ form.errors.ddo_code
                            }}</div>
                        </div>
                        <div>
                            <label>Number of Scections</label>
                            <input v-model="form.section" type="number" class="border p-2 w-full" />
                            <div class="text-red-500 text-sm" v-if="form.errors.section">{{ form.errors.section
                            }}</div>
                        </div>

                    </div>
                </div>


                <div class="form-group text-right">
                    <Button type="submit" :loading="form.processing">
                        <span v-if="form.processing">Editing</span>
                        <span v-else>Edit</span>
                    </Button>
                    <Link :href="route('offices.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
