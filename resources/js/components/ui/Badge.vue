<template>
    <span :class="badgeClasses"
        class="inline-flex items-center px-2.5 py-1 justify-center gap-1 rounded-full font-medium capitalize text-sm">
        <slot></slot>

        <i v-if="badgeIcon" :class="badgeIcon"></i>
    </span>
</template>


<script>

export default {
    props: {
        type: {
            type: String,
            required: false,
        },
        icon: {
            type: String,
            default: null,
        },
        no_icon: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        badgeClasses() {
            switch (this.type) {
                case 'success':
                    return 'bg-green-100 text-green-600 dark:bg-green-500/15 dark:text-green-500';
                case 'danger':
                    return 'bg-red-100 text-red-600 dark:bg-red-500/15 dark:text-red-500';
                default:
                    return 'bg-gray-100 text-gray-600 dark:bg-gray-500/15 dark:text-gray-500';
            }
        },
        badgeIcon() {
            if (this.no_icon) {
                return null;
            }
            if (this.icon) {
                return this.icon;
            }
            switch (this.type) {
                case 'success':
                    return 'fa fa-check-circle';
                case 'danger':
                    return 'fa fa-times-circle';
                default:
                    return null;
            }
        }
    },
};
</script>