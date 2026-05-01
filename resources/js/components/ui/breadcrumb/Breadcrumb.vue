<script lang="ts" setup>
import { usePage } from '@inertiajs/vue3';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
const page = usePage();
</script>

<template>
    <nav aria-label="breadcrumb" :class="props.class">
        <div class="flex justify-between w-full">
            <slot />
            <div class="flex-1 ml-10">
                <span class="text-gray-500 font-bold">{{ page.props.quote.message }}</span> <span
                    class="text-gray-400">-{{
                        page.props.quote.author }}</span>
            </div>
        </div>
    </nav>
</template>
