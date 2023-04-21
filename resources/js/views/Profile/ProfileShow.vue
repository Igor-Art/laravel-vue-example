<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import http from '@/http'
import UserDefaultAvatar from '@images/user-default.png'

const route = useRoute()

const user = ref({})

const fetchUser = async (name) => {
  const response = await http.get(`/api/users/${name}`)

  user.value = response.data.data
}

await fetchUser(route.params.name)
</script>

<template>
  <div class="pt-10">
    <div class="flex">
      <div class="mr-6 text-center">
        <div class="w-32 mb-4">
          <img :src="UserDefaultAvatar" :alt="user.name" />
        </div>
        <div>Reviews: {{ user.reviews_count || 0 }}</div>
        <div>Wishlist: {{ user.wishlist_count || 0 }}</div>
      </div>
      <div class="pt-5">
        <div class="text-2xl">{{ user.name }}</div>
        <div class="mb-3 text-base">{{ user.email }}</div>
        <div>Registered: {{ $date.formatDate(user.registered_at) }} ({{ $date.ago(user.registered_at) }})</div>
      </div>
    </div>
  </div>
</template>
