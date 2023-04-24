<script setup>
const props = defineProps({
  game: {
    type: Object,
    required: true,
  }
})

</script>

<template>
  <div>
    <div class="input-row">
      You mark: 1-2-3-4-5
    </div>
    <div class="input-row">
      <textarea class="input" placeholder="You review..."></textarea>
    </div>
    <div class="input-row text-right">
      <button class="button default">Create</button>
    </div>
  </div>
</template>
