<script setup>
defineProps({
  to: {
    type: [String, Object],
    required: true,
  },
  label: {
    type: String,
    default: 'Read more'
  }
})
</script>

<template>
  <RouterLink :to="to" class="inline-flex">
    <span class="mr-1">{{ label }}</span>
    <font-awesome-icon icon="angles-right" class="mt-1 mr-1 w-2.5" />
  </RouterLink>
</template>
