<script setup>
import { defineAsyncComponent, onErrorCaptured, ref } from 'vue'
import AsyncLoading from '@/components/AsyncLoader/AsyncLoading.vue'
import ErrorLoading from '@/components/AsyncLoader/ErrorAsyncLoading.vue'
import Headline from '@/components/Headline.vue'
import MoreLink from '@/components/MoreLink.vue'

const GameTopList = defineAsyncComponent(() => import('@/components/Games/GameTopList.vue'))

const error = ref('')

onErrorCaptured(() => {
  error.value = 'Error loading game list, please try again later'
})
</script>

<template>
  <Headline icon="star">
    <div class="flex justify-between items-center">
      <span>Top Games</span>
      <MoreLink to="/" label="Show all" class="text-sm mr-1" />
    </div>
  </Headline>
  <Suspense>
    <GameTopList />
    <template #fallback>
      <ErrorLoading v-if="error" :message="error" />
      <AsyncLoading v-else />
    </template>
  </Suspense>
</template>
