<script>
import { ref, watch, computed } from 'vue';

export default {
    name: 'LangInput',
    props: {
        modelValue: {
            type: Object,
            required: true,
        },
        languages: {
            type: Array,
            required: true,
        },
        placeholder: {
            type: String,
            default: '',
        },
        label: {
            type: String,
            default: '',
        },
    },
    emits: ['update:modelValue'],
    data() {
        const initialLang = this.languages.find(lang => this.modelValue?.[lang]) || this.languages[0];
        return {
            currentLang: initialLang,
            inputValue: this.modelValue[initialLang] || '',
        };
    },
    watch: {
        modelValue: {
            handler(newVal) {
                // Only update inputValue for the current language
                this.inputValue = newVal[this.currentLang] || '';
            },
            deep: true,
            immediate: true,
        },
        languages(newLangs) {
            // If languages prop changes, update currentLang
            const found = newLangs.find(lang => this.modelValue?.[lang]);
            this.currentLang = found || newLangs[0];
            this.inputValue = this.modelValue[this.currentLang] || '';
        },
        currentLang(newLang) {
            // When language changes, update inputValue
            this.inputValue = this.modelValue[newLang] || '';
        },
        inputValue(newVal) {
            // Emit value change
            this.$emit('update:modelValue', { ...this.modelValue, [this.currentLang]: newVal });
        },
    },
    methods: {
        onInput(e) {
            this.inputValue = e.target.value;
        },
        onLangChange(e) {
            alert('Language changed to: ' + e.target.value);
            this.currentLang = e.target.value;
        },
    },
};
</script>

<template>
    <div class="relative flex items-center">
        <input
            :placeholder="placeholder"
            class="border p-2 w-full pr-20"
            :value="inputValue"
            @input="onInput"
        />
        <select
            :value="currentLang"
            @change="onLangChange"
            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white rounded px-2 py-1 text-sm"
        >
            <option v-for="lang in languages" :key="lang" :value="lang">
                {{ lang.toUpperCase() }}
            </option>
        </select>
    </div>
</template>
