<script setup>
import { computed } from 'vue'

const props = defineProps({
  rating: {
    type: [Number, String, null],
    required: true,
  },
  iconClass: {
    type: String,
    default: '',
  }
})

const max = 5;

const labelOf = computed(() => `Rating ${props.rating}/${max}`)
const intRating = computed(() => !props.rating ? 0 : (!isNaN(parseInt(props.rating)) ? parseInt(props.rating) : 0))
</script>

<template>
  <div :aria-label="labelOf" :title="labelOf">
    <font-awesome-icon
      v-for="index in intRating"
      :key="index"
      icon="star"
      :class="iconClass"
    />
  </div>
</template>
