<template>
  <button @click="handelClick" :type="type" :disabled="disabled || loading"
    class="inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white"
    :class="classes">
    <slot>Submit</slot>
    <i v-if="loading && spinner" class="fa fa-spinner fa-spin ml-2"></i>
  </button>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue'
import { router } from '@inertiajs/vue3';
import FontAwesomeIcon from '@/plugins/fontawesome';


const props = defineProps({
  type: {
    type: String,
    default: 'submit',
  },
  loading: {
    type: Boolean,
    default: false
  },
  classes: {
    type: String,
    default: null,
  },
  hideLabel: {
    type: Boolean,
    default: false,
  },
  uppercase: {
    type: Boolean,
    default: true
  },
  varient: {
    type: String,
    default: 'dark'
  },
  class: {
    type: String,
    default: ''
  },
  size: {
    type: String,
    default: 'md'
  },
  spinner: {
    type: Boolean,
    default: true
  },
  btnDropdown: {
    type: Boolean,
    default: false
  },
  disabled: {
    type: Boolean,
    default: false
  }
})

const classes = ref('');
const buttonKey = ref('');
const clicked = ref(false);

onMounted(() => {
  let classesArray = [];
  if (props.btnDropdown) {
    classesArray.push('dropdown-item')
  } else {
    classesArray.push(`btn-${props.varient}`);
    classesArray.push(props.size ? `btn-${props.size}` : '');
  }
  classesArray.push(`${props.class}`);
  classesArray.push(props.uppercase ? `text-uppercase` : '');
  if (props.classes) classesArray.push(props.classes)
  classes.value = classesArray.join(' ');
  buttonKey.value = uniqueKey();
})

const handelClick = () => {
  clicked.value = true;
}

const removeEventListener = router.on('finish', () => {
  clicked.value = false;
})

const uniqueKey = (length = 10) => {
  var result = '';
  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;
  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

onUnmounted(() => removeEventListener())

</script>