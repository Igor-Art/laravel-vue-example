<script setup>
import { computed } from 'vue'
import RatingConfig from '@/config/rating'

const props = defineProps({
  rating: {
    type: [Number, String, null, undefined],
    required: true,
  },
  iconClass: {
    type: String,
    default: '',
  }
})

const labelOf = computed(() => `Rating ${props.rating}/${RatingConfig.max}`)
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
