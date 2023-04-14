<script setup>
defineProps({
  icon: {
    type: [String, Array],
    default: undefined,
  },
})
</script>

<template>
  <div class="flex items-center mb-3 text-xl">
    <font-awesome-icon v-if="icon" :icon="icon" class="h-4 mr-2" />
    <div>
      <slot />
    </div>
  </div>
</template>
