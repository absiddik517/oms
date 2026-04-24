<template>
    <v-select v-model="form.cc" :options="recipients" label="name" :reduce="r => r.id" multiple
        placeholder="Select CC recipients..." />
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

export default {
    components: {
        vSelect,
    },
}
</script>