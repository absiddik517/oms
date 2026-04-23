
<template>
  <TransitionGroup 
    tag="div"  
    name="fadeRight"
    class="toast-wrapper">
    <ToastItem 
      v-for="(item, index) in toast.items"
      :item="item" 
      :index="index"
      :key="item.key"
      @remove="toast.remove(index)"
    />
  </TransitionGroup>
</template>

<script setup>
import toast from '@/functions/toast'
import { usePage, router } from '@inertiajs/vue3'
import { onUnmounted } from 'vue'
import ToastItem from './ToastItem.vue'

const page = usePage()


// Inertia finish event listener (new way)
const removeEventListener = router.on('finish', () => {
    if (page.props.toast) {
    console.log(page.props.toast)
    toast.add(page.props.toast)
  }
})

onUnmounted(() => {
  removeEventListener()
})
</script>

<style scoped>
.toast-wrapper {
  position: fixed;
  top: 0;
  right: 0;
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

/* Enter animation start state */
.fadeRight-enter-from {
  opacity: 0;
  transform: translateX(30px);
}

/* Enter animation active */
.fadeRight-enter-active {
  transition: all 0.4s ease;
}

/* Enter animation end state */
.fadeRight-enter-to {
  opacity: 1;
  transform: translateX(0);
}

/* Leave animation start */
.fadeRight-leave-from {
  opacity: 1;
  transform: translateX(0);
}

/* Leave animation active */
.fadeRight-leave-active {
  transition: all 0.3s ease;
  position: absolute; /* important for smooth stack */
}

/* Leave animation end */
.fadeRight-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>