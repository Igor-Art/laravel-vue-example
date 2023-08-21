<script setup>
import { computed } from 'vue'
import { useModalsStore } from '@/stores/modals'

const props = defineProps({
  modal: {
    type: Object,
    required: true,
  },
})

const modals = useModalsStore()
const show = computed(() => modals.stack.indexOf(props.modal.getId()) === 0)
</script>

<template>
  <Teleport to="body">
    <div v-if="show">
      <div class="fixed top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-6 border border-white border-opacity-40 rounded-lg shadow-xl w-full max-w-sm bg-card backdrop-blur">
        <div class="mb-4">
          <slot name="header"/>
        </div>
        <slot/>
      </div>
    </div>
  </Teleport>
</template>
