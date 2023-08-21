<script setup>
import { computed } from 'vue'
import { useModalsStore } from '@/stores/modals'

const modals = useModalsStore()
const show = computed(() => modals.stack.length)
</script>

<template>
  <div v-if="show" class="overlay fixed inset-0 bg-black bg-opacity-10 backdrop-blur-sm" @click="modals.close()"></div>
</template>
