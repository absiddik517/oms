<template>
  <div class="toast show" role="alert" style="transition: all 1s;">
      <div class="toast-header">
        <i class="fa mr-2" :class="{
          'text-danger fa-times-circle': item.type == 'error',
          'text-success fa-check-circle': item.type == 'success',
        }"></i>
        <strong class="me-auto toast-title" :class="{
          'text-danger': item.type == 'error',
          'text-success': item.type == 'success',
        }">
          <span v-if="item.type=='success'">Success</span>
          <span v-if="item.type == 'error'">Error</span>
        </strong>
        <small>Close in {{ second }} second<span v-if="second > 1">s</span></small>
        <button type="button" class="btn-close" @click="emit('remove')">
            <Icon name="x"/>
        </button>
      </div>
      <div class="timer d-flex justify-content-end"><div :class="{
        'bg-danger': item.type == 'error',
        'bg-success': item.type == 'success',
      }" :style="width"></div></div>
      <div class="toast-body toast-message" v-html="item.message"></div>
    </div>
</template>

<script setup>
  import Icon from '@/components/Icon.vue';
import { onMounted, ref } from 'vue'
  const props = defineProps({
    item: {
      type: Object,
      default: {
        message: 'Message not found',
        type: 'error'
      }
    },
    index: {
      type: Number, 
      default: null
    },
    removeAfter: {
      type: Number, 
      default: 20000
    },
  })

  
  const width = ref('width: 100%');
  const second = ref(20);
  
  const emit = defineEmits(['remove'])
  
  onMounted(() => {
    const myInterval = setInterval(() => {
      let diff = props.item.time + props.removeAfter - Date.now();
      let persent = (diff/props.removeAfter)*100;
      second.value = Math.round(diff / 1000);
      width.value = `width: ${persent}%`;
      //console.log(width.value)
      if(diff < 1){
        emit('remove')
        clearInterval(myInterval)
      }
    }, 1)
  })
  
</script>

<style scoped>
  .timer{
    width: 100%;
    height: 2px;
    padding: 0 2px;
  }
  .timer div{
    height: 100%;
    border-radius: 4px;
  }
  .toast-title{
    font-family: 'Space Mono', Monospace;
  }
  
  .toast-message {
    font-family: 'Raleway', Sans-Serif;
    font-weight: 400;
    font-size: 1rem;
  }

  /* Toast container */
.toast {
  width: 320px;
  background: #ffffff;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  transition: all 1s ease;
  font-family: Arial, sans-serif;
}

/* Header */
.toast-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 14px;
  border-bottom: 1px solid #f1f1f1;
}

/* Left section (icon + title) */
.toast-header .left {
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Title */
.toast-title {
  font-size: 14px;
  font-weight: 600;
}

/* Success / Error colors */
.text-success {
  color: #16a34a;
}

.text-danger {
  color: #dc2626;
}

/* Icon size */
.toast-header i {
  font-size: 18px;
}

/* Close button */
.btn-close {
  border: none;
  background: transparent;
  cursor: pointer;
  font-size: 16px;
  color: #6b7280;
}

.btn-close:hover {
  color: #111827;
}

/* Timer text */
.toast-header small {
  font-size: 12px;
  color: #6b7280;
}

/* Progress bar container */
.timer {
  width: 100%;
  height: 4px;
  background: #f3f4f6;
}

/* Progress bar */
.timer > div {
  height: 100%;
  transition: width 0.3s linear;
}

/* Success / Error backgrounds */
.bg-success {
  background-color: #16a34a;
}

.bg-danger {
  background-color: #dc2626;
}

/* Toast body */
.toast-body {
  padding: 10px 14px;
  font-size: 13px;
  color: #374151;
}
</style>