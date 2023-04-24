<script setup>
const props = defineProps({
  modelValue: {
    required: true,
  },
  max: {
    type: Number,
    required: true,
  }
})

const emit = defineEmits(['update:modelValue'])

function changeRating(value) {
  emit('update:modelValue', value)
}
</script>

<template>
  <div>
    <font-awesome-icon
      v-for="index in props.max"
      :key="index"
      :icon="index <= modelValue ? ['solid', 'star'] : ['regular', 'star']"
      class="text-3xl mr-1 cursor-pointer hover:text-yellow-500"
      @click="changeRating(index)"
    />
  </div>
</template>
