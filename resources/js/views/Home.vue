<script setup>
import { defineAsyncComponent, onErrorCaptured, ref } from 'vue'
import AsyncLoading from '@/components/AsyncLoader/Loading.vue'
import ErrorLoading from '@/components/AsyncLoader/ErrorLoading.vue'

const GamesTopList = defineAsyncComponent(() => import('@/components/Games/TopList.vue'))

const error = ref('')

onErrorCaptured((e) => {
  error.value = 'Error loading game list, please try again later'
})
</script>

<template>
  <div>
    <div class="flex items-center mb-2 text-xl">
      <font-awesome-icon icon="star" class="h-4 mr-2" />
      <span>Top Games</span>
    </div>
    <Suspense>
      <GamesTopList />
      <template #fallback>
        <ErrorLoading v-if="error" :message="error" />
        <AsyncLoading v-else />
      </template>
    </Suspense>
  </div>
</template>
