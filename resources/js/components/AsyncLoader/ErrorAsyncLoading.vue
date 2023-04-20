<script setup>
defineProps({
  message: {
    type: String,
    required: true,
  }
})
</script>

<template>
  <div class="text-app-warning text-opacity-80 italic">
    {{ message }}
  </div>
</template>
