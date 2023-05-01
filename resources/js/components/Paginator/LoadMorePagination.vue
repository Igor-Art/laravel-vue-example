<script setup>
defineEmits(['demanded'])

defineProps({
  disabled: {
    type: Boolean,
    required: true,
  }
})
</script>

<template>
  <div>
    <button
      :disabled="disabled"
      @click="$emit('demanded')"
      class="inline-block py-2 px-4
      border border-primary border-opacity-50 rounded
      transition hover:border-sky-400 hover:bg-sky-600
      disabled:border-primary disabled:border-opacity-50 disabled:bg-transparent"
    >
      <font-awesome-icon icon="angles-down" class="mr-2" />
      <span class="mr-2">Load more</span>
      <font-awesome-icon icon="angles-down" />
    </button>
  </div>
</template>
