<script setup>
import { defineAsyncComponent, onErrorCaptured, ref } from 'vue'
import AsyncLoading from '@/components/AsyncLoader/Loading.vue'
import ErrorLoading from '@/components/AsyncLoader/ErrorLoading.vue'

const ReviewsLastList = defineAsyncComponent(() => import('@/components/Reviews/LastList.vue'))

const error = ref('')

onErrorCaptured(() => {
  error.value = 'Error loading reviews list, please try again later'
})
</script>

<template>
  <div class="flex items-center mb-3 text-xl">
    <font-awesome-icon icon="comments" class="h-4 mr-2" />
    <span>Last Reviews</span>
  </div>
  <Suspense>
    <ReviewsLastList />
    <template #fallback>
      <ErrorLoading v-if="error" :message="error" />
      <AsyncLoading v-else />
    </template>
  </Suspense>
</template>
