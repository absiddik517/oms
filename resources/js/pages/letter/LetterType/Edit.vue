<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import LangInput from '@/components/ui/form/LangInput.vue';
import Button from '@/components/ui/Button.vue';
import Input from '@/components/ui/form/Input.vue';

export default {
    name: 'LetterTypeEdit',
    components: {
        AppLayout,
        Head,
        Link,
        LangInput,
        Button,
        Input,
    },
    props: {
        letterType: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: useForm({
                "name": this.letterType.name,
                "code": this.letterType.code,

            }),
            loading: false,
            breadcrumbs: [
                { title: 'Letter Types', href: route('letter-types.index') },
                { title: 'Edit', href: route('letter-types.edit', this.letterType.id) },
            ],
        };
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.clearErrors();
            this.form.put(route('letter-types.update', this.letterType.id), {
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

    <Head title="Add Letter Type" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Edit Letter Type</h1>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="letter_type">Letter Type</label>
                    <Input v-model="form.name" id="letter_type" class="mt-2" type="text" placeholder="Letter Type" />
                    <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div>
                    <label for="letter_code">Letter Code</label>
                    <Input v-model="form.code" id="letter_code" class="mt-2" type="text" placeholder="Letter Code" />
                    <div class="text-red-500 text-sm" v-if="form.errors.code">{{ form.errors.code }}</div>
                </div>
                <div class="form-group text-right">
                    <Button type="submit" :loading="loading">
                        <span v-if="loading">Updating...</span>
                        <span v-else>Update</span>
                    </Button>
                    <Link :href="route('letter-types.index')" class="ml-2 text-gray-600">Cancel</Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
