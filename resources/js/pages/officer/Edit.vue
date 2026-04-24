<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'OfficerEdit',
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
        officer: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: useForm({
                'office_id': this.officer.office_id || '',
                'name': this.officer.name || null,
                'designation': this.officer.designation || null,
                'category': this.officer.category || 'regular',
                'address': this.officer.address || null,
                'email': this.officer.email || null,
                'phone': this.officer.phone || null,
                'joining_date': this.officer.joining_date || null,
                'status': this.officer.status || 'active',
                'leaving_date': this.officer.leaving_date || null,
            }),
            loading: false,
            breadcrumbs: [
                { title: 'Officers', href: route('officers.index') },
                { title: 'Edit', href: route('officers.edit', this.officer.id) },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.put(route('officers.update', this.officer.id), {
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

    <Head title="Add Officer" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Add Officer</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div v-if="$page.props.auth.user.role === 'admin'">
                    <label for="office_id">Office</label>
                    <select v-model="form.office_id" id="office_id"
                        class="flex h-9 w-full rounded-xl border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
                        <option value="" disabled>Select Office</option>
                        <option v-for="office in offices" :key="office.id" :value="office.id">
                            {{ JSON.parse(office.office_name).bn }}, {{ JSON.parse(office.upazila).bn }}, {{
                                JSON.parse(office.district).bn }}
                        </option>
                    </select>
                    <div class="text-red-500 text-sm" v-if="form.errors.office_id">{{ form.errors.office_id }}</div>
                </div>
                <div class="flex gap-2 flex-wrap">
                    <div class="flex-1">
                        <label for="name">Name</label>
                        <Input v-model="form.name" id="name" class="mt-2" type="text" placeholder="Name" />
                        <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>
                    <div class="flex-1">
                        <label for="joining_date">Joining Date</label>
                        <Input v-model="form.joining_date" id="joining_date" class="mt-2" type="date"
                            formate="yyyy-mm-dd" placeholder="Joining Date" />
                        <div class="text-red-500 text-sm" v-if="form.errors.joining_date">{{ form.errors.joining_date }}
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="flex-1">
                        <label for="designation">Designation</label>
                        <Input v-model="form.designation" id="designation" class="mt-2" type="text"
                            placeholder="Designation" />
                        <div class="text-red-500 text-sm" v-if="form.errors.designation">{{ form.errors.designation }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <span>&nbsp;</span>
                        <div class="mt-4 flex flex-wrap items-center gap-8">

                            <!-- Default -->
                            <label class="flex cursor-pointer items-center text-sm font-medium text-gray-700">
                                <div class="relative mr-3">
                                    <input type="radio" value="regular" v-model="form.category" class="sr-only">

                                    <div :class="form.category === 'regular'
                                        ? 'border-blue-500 bg-blue-500'
                                        : 'border-gray-300 bg-transparent'"
                                        class="flex h-5 w-5 items-center justify-center rounded-full border">
                                        <span v-if="form.category === 'regular'"
                                            class="h-2 w-2 rounded-full bg-white"></span>
                                    </div>
                                </div>
                                Regular
                            </label>

                            <!-- Additional Charge -->
                            <label class="flex cursor-pointer items-center text-sm font-medium text-gray-700">
                                <div class="relative mr-3">
                                    <input type="radio" value="additional" v-model="form.category" class="sr-only">

                                    <div :class="form.category === 'additional'
                                        ? 'border-blue-500 bg-blue-500'
                                        : 'border-gray-300 bg-transparent'"
                                        class="flex h-5 w-5 items-center justify-center rounded-full border">
                                        <span v-if="form.category === 'additional'"
                                            class="h-2 w-2 rounded-full bg-white"></span>
                                    </div>
                                </div>
                                Additional Charge
                            </label>

                            <label class="flex cursor-pointer items-center text-sm font-medium text-gray-700">
                                <div class="relative mr-3">
                                    <input type="radio" value="current" v-model="form.category" class="sr-only">

                                    <div :class="form.category === 'current'
                                        ? 'border-blue-500 bg-blue-500'
                                        : 'border-gray-300 bg-transparent'"
                                        class="flex h-5 w-5 items-center justify-center rounded-full border">
                                        <span v-if="form.category === 'current'"
                                            class="h-2 w-2 rounded-full bg-white"></span>
                                    </div>
                                </div>
                                Current Charge
                            </label>

                        </div>
                        <div class="text-red-500 text-sm mt-2" v-if="form.errors.category">{{ form.errors.category }}
                        </div>
                    </div>
                </div>
                <div>
                    <label for="address">Address</label>
                    <Input v-model="form.address" id="address" class="mt-2" type="text" placeholder="Address" />
                    <div class="text-red-500 text-sm" v-if="form.errors.address">{{ form.errors.address }}</div>
                </div>
                <div class="flex gap-2">
                    <div class="flex-1">
                        <label for="email">Email</label>
                        <Input v-model="form.email" id="email" class="mt-2" type="email" placeholder="Email" />
                        <div class="text-red-500 text-sm" v-if="form.errors.email">{{ form.errors.email }}</div>
                    </div>
                    <div class="flex-1">
                        <label for="phone">Phone</label>
                        <Input v-model="form.phone" id="phone" class="mt-2" type="text" placeholder="Phone" />
                        <div class="text-red-500 text-sm" v-if="form.errors.phone">{{ form.errors.phone }}</div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="flex-1">
                        <label for="status">Status</label>
                        <select v-model="form.status" id="status"
                            class="mt-2 flex h-9 w-full rounded-xl border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
                            <option value="" disabled>Select Status</option>
                            <option value="active">Active</option>
                            <option value="leaved">Leaved</option>
                        </select>
                        <div class="text-red-500 text-sm" v-if="form.errors.status">{{ form.errors.status }}</div>
                    </div>
                    <div v-if="form.status === 'leaved'" class="flex-1">
                        <label for="leaving_date">Leaving Date</label>
                        <Input v-model="form.leaving_date" id="leaving_date" class="mt-2" type="date" />
                        <div class="text-red-500 text-sm" v-if="form.errors.leaving_date">{{ form.errors.leaving_date }}
                        </div>
                    </div>
                </div>


                <div class="form-group text-right">
                    <Button type="submit" :loading="form.processing">
                        <span v-if="form.processing">Creating</span>
                        <span v-else>Update</span>
                    </Button>
                    <Link :href="route('officers.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
            <div>
                <pre>{{ form }}</pre>
            </div>
        </div>
    </AppLayout>
</template>
