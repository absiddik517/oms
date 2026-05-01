<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'OfficerCreate',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
        Input,
    },
    props: {
        offices: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            form: useForm({
                office_id: this.$page.props.auth.user.office_id,
                name: '',
                designation: '',
                suboridinate_office_name: null,
                suboridinate_office_code: null,
                section_name: null,
                section_code: null,
                email: '',
                phone: '',
                joining_date: '',
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Officers', href: route('officers.index') },
                { title: 'Create', href: route('officers.create') },
            ],
        };
    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        }
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.post(route('officers.store'), {
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
            <h1 class="text-2xl font-bold mb-4">Add Office</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="bg-white rounded-xl shadow p-6 space-y-4 w-full md:w-1/2">
                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            Personal Information
                        </h2>
                        <div>
                            <label>Name</label>
                            <input v-model="form.name" type="text" class="border p-2 w-full" />

                            <div class="text-red-500 text-sm" v-if="form.errors.name">{{
                                form.errors.name }}</div>
                        </div>

                        <div>
                            <label>Designation</label>
                            <input v-model="form.designation" type="text" class="border p-2 w-full" />

                            <div class="text-red-500 text-sm" v-if="form.errors.designation">{{
                                form.errors.designation }}</div>
                        </div>

                        <div>
                            <label>Email</label>
                            <input v-model="form.email" type="text" class="border p-2 w-full" />

                            <div class="text-red-500 text-sm" v-if="form.errors.email">{{
                                form.errors.email }}</div>
                        </div>

                        <div>
                            <label>Phone</label>
                            <input v-model="form.phone" type="text" class="border p-2 w-full" />

                            <div class="text-red-500 text-sm" v-if="form.errors.phone">{{
                                form.errors.phone }}</div>
                        </div>


                    </div>

                    <div class="bg-white rounded-xl shadow p-6 space-y-4 w-full md:w-1/2">
                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            Office Information
                        </h2>

                        <div>
                            <label>Office</label>
                            <input v-model="form.office_id" type="text" class="border p-2 w-full" />
                            <div class="text-red-500 text-sm" v-if="form.errors.office_id">{{
                                form.errors.office_id
                            }}</div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-2">
                            <div>
                                <label>Suboridinate Office Name</label>
                                <input v-model="form.suboridinate_office_name" type="text" class="border p-2 w-full" />
                                <div class="text-red-500 text-sm" v-if="form.errors.suboridinate_office_name">{{
                                    form.errors.suboridinate_office_name
                                }}</div>
                            </div>
                            <div>
                                <label>Suboridinate Office Code</label>
                                <input v-model="form.suboridinate_office_code" type="text" class="border p-2 w-full" />
                                <div class="text-red-500 text-sm" v-if="form.errors.suboridinate_office_code">{{
                                    form.errors.suboridinate_office_code
                                }}</div>
                            </div>
                        </div>


                        <div class="flex flex-col md:flex-row gap-2">
                            <div>
                                <label>Section Name</label>
                                <input v-model="form.section_name" type="text" class="border p-2 w-full" />
                                <div class="text-red-500 text-sm" v-if="form.errors.section_name">{{
                                    form.errors.section_name
                                }}</div>
                            </div>

                            <div>
                                <label>Section Code</label>
                                <input v-model="form.section_code" type="text" class="border p-2 w-full" />
                                <div class="text-red-500 text-sm" v-if="form.errors.section_code">{{
                                    form.errors.section_code
                                }}</div>
                            </div>
                        </div>
                        <div>
                            <label>Joining Date</label>
                            <input v-model="form.joining_date" type="date" class="border p-2 w-full" />
                            <div class="text-red-500 text-sm" v-if="form.errors.joining_date">{{
                                form.errors.joining_date
                            }}</div>
                        </div>

                    </div>
                </div>


                <div class="form-group text-right">
                    <Button type="submit" :loading="form.processing">
                        <span v-if="form.processing">Creating</span>
                        <span v-else>Create</span>
                    </Button>
                    <Link :href="route('offices.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
