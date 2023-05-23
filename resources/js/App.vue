<script setup>
import { onMounted } from 'vue'
import { RouterView } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import HeaderNav from '@/components/Layout/HeaderNav.vue'
import AsyncLoading from '@/components/AsyncLoader/AsyncLoading.vue'

const authStore = useAuthStore()

onMounted(() => {
  authStore.refreshUser()
})
</script>

<template>
  <header class="bg-black bg-opacity-20 border-b border-black border-opacity-20">
    <HeaderNav />
  </header>
  <main class="container pt-8 pb-10">
    <RouterView v-slot="{ Component, route }">
      <template v-if="Component">
        <Transition name="fade" mode="out-in">
          <KeepAlive :include="[]">
            <Suspense :timeout="0">
              <Component :is="Component" :key="route.path" />
              <template #fallback>
                <AsyncLoading />
              </template>
            </Suspense>
          </KeepAlive>
        </Transition>
      </template>
    </RouterView>
  </main>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .4s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
