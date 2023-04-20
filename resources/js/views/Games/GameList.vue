<script setup>
import { defineAsyncComponent, onErrorCaptured, ref } from 'vue'
import GameFilter from '@/components/Games/GameFilter.vue'
import ErrorLoading from '@/components/AsyncLoader/ErrorAsyncLoading.vue'
import AsyncLoading from '@/components/AsyncLoader/AsyncLoading.vue'
import Headline from '@/components/Headline.vue'

const GameFilterResults = defineAsyncComponent(() => import('@/components/Games/GameFilterResults.vue'))

const error = ref('')

onErrorCaptured(() => {
  error.value = 'Error loading games, please try again later'
})
</script>

<template>
  <div>
    <Headline icon="gamepad" class="mb-6">Find your dream game</Headline>
    <div class="mb-10">
      <GameFilter />
    </div>
    <div>
      <Suspense>
        <GameFilterResults />
        <template #fallback>
          <ErrorLoading v-if="error" :message="error" />
          <AsyncLoading v-else />
        </template>
      </Suspense>
    </div>
  </div>
</template>
