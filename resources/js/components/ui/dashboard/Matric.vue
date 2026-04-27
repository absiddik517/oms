<template>
    <div class="rounded-xl h-full border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
            <slot name="icon" />
        </div>

        <div class="mt-5 flex items-end justify-between">
            <div>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{ props.title }}
                </span>
                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                    {{ props.count }}
                </h4>
            </div>

            <span
                class="flex items-center gap-1 rounded-full bg-success-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                <i v-if="props.change > 0" class="text-green-600 fa fa-arrow-up"></i>
                <i v-else class="text-red-600 fa fa-arrow-down"></i>
                <span v-if="props.change > 0" class="text-green-600">{{ props.change }}</span>
                <span v-else class="text-red-600">{{ props.change }}</span>
            </span>
        </div>
    </div>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue'
import { router } from '@inertiajs/vue3';
import FontAwesomeIcon from '@/plugins/fontawesome';


const props = defineProps({
    count: {
        type: Number,
        default: 0,
    },
    title: {
        type: String,
        default: 'Title'
    },
    change: {
        type: String,
        default: '11.01%',
    },
})


</script>