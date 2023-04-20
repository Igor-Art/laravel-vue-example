<script setup>
import { defineAsyncComponent, onErrorCaptured, ref } from 'vue'
import AsyncLoading from '@/components/AsyncLoader/AsyncLoading.vue'
import ErrorLoading from '@/components/AsyncLoader/ErrorAsyncLoading.vue'
import Headline from '@/components/Headline.vue'

const ReviewsLastList = defineAsyncComponent(() => import('@/components/Reviews/ReviewLastList.vue'))

const error = ref('')

onErrorCaptured(() => {
  error.value = 'Error loading reviews list, please try again later'
})
</script>

<template>
  <Headline icon="comments">Last Reviews</Headline>
  <Suspense>
    <ReviewsLastList />
    <template #fallback>
      <ErrorLoading v-if="error" :message="error" />
      <AsyncLoading v-else />
    </template>
  </Suspense>
</template>
