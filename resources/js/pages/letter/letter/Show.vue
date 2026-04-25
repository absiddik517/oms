<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

export default {
    name: 'LetterShow',

    components: {
        AppLayout,
        Head,
        Link,
    },

    props: {
        letter: Object,
    },
    methods: {
        toBN(num) {
            return num.toString().replace(/\d/g, d => '০১২৩৪৫৬৭৮৯'[d]);
        }
    },
    computed: {
        toRecipients() {
            return this.letter.recipients?.filter(r => r.pivot.type === 'to') || [];
        },

        ccRecipients() {
            return this.letter.recipients?.filter(r => r.pivot.type === 'cc') || [];
        },
    },
};
</script>

<template>

    <Head :title="letter.subject" />

    <AppLayout>
        <div style="font-family: SolaimanLipi" class="text-md max-w-4xl mx-auto p-6 bg-white shadow rounded">

            <!-- HEADER -->
            <div class="border-b pb-4 mb-4">
                <h4 class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
                <h4 class="text-center">উপজেলা উপানুষ্ঠানিক শিক্ষা কর্মকর্তার কার্যালয়</h4>
                <h4 class="text-center">{{ JSON.parse(letter.office.office_name).bn }}</h4>
                <h4 class="text-center">{{ JSON.parse(letter.office.upazila).bn }}, {{
                    JSON.parse(letter.office.district).bn }}</h4>

                <div class="flex items-center">
                    <div class="text-gray-600 mt-1">
                        <p>স্মারক নং: ৩৮.০২.{{ toBN(letter.office.geo_code) }}.০০০.{{ toBN(letter.topic.code) }}.{{
                            toBN(letter.folder.code) }}.{{
                                toBN(new Date(letter.letter_date).getFullYear().toString().slice(-2)) }}-{{
                                toBN(letter.letter_number) }}
                        </p>
                    </div>

                    <div class="ml-auto text-gray-600 mt-1 flex items-center gap-0.5">
                        <div>তারিখ:</div>
                        <div class="flex-1 text-center">
                            <div class="border-b border-black">{{ letter.date.lunar }} খ্রিস্টাব্দ</div>
                            <div>{{ letter.date.gregorian }} খ্রিস্টাব্দ</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUBJECT  -->
            <div class="mb-4 flex">
                <div>বিষয়:</div>
                <div class="ml-2 flex-1 text-justify"><b>{{ letter.subject }}</b></div>
            </div>

            <!-- Letter Body -->
            <div class="mb-4">
                <p class="text-justify tracking-wide" v-html="letter.body"></p>
            </div>

            <!-- TO and Officer Signature -->
            <div class="flex mt-16">
                <div>
                    <p class="font-bold">{{ letter.to[0].designation }}</p>
                    <p class="">{{ letter.to[0].organization }}</p>
                    <p class="">{{ letter.to[0].address }}</p>
                </div>
                <div class="ml-auto p-4 text-center">
                    <p class="font-bold ml-auto">{{ JSON.parse(letter.office.office_name).bn }}</p>
                    <p class="ml-auto">{{ JSON.parse(letter.office.upazila).bn }}, {{
                        JSON.parse(letter.office.district).bn }}</p>
                </div>
            </div>


            <!-- CC -->
            <div class="mb-4" v-if="letter.cc.length">
                <b>অনুলিপি সদয় অবগতি ও কার্যার্থে:</b>
                <ol class="list-decimal list-inside">
                    <li v-for="c in letter.cc" :key="c.id" class="ml-0">
                        {{ c.designation }}, {{ c.organization }}<span v-if="c.organization">,</span>
                        {{ c.address }}
                    </li>
                    <li>অফিস কপি।</li>
                </ol>
            </div>


            <!-- ATTACHMENTS -->
            <div v-if="letter.attachments?.length">
                <h3 class="font-semibold mb-2">Attachments</h3>

                <ul class="space-y-1">
                    <li v-for="file in letter.attachments" :key="file.id">
                        <a :href="`/storage/${file.file_path}`" target="_blank" class="text-blue-600 hover:underline">
                            📎 {{ file.file_name }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ACTIONS -->
            <div class="mt-6 flex justify-end gap-2">
                <Link :href="route('letters.index')" class="px-4 py-2 border rounded">
                Back
                </Link>

                <Link :href="route('letters.edit', letter.id)" class="px-4 py-2 bg-black text-white rounded">
                Edit
                </Link>
            </div>

        </div>
    </AppLayout>
</template>