<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import http from '@/http'
import { useMeta } from '@/plugins/meta'
import UserDefaultAvatar from '@images/user-default.png'

const route = useRoute()

const user = ref({})

const fetchUser = async (id) => {
  const response = await http.get(`/api/users/${id}`)

  user.value = response.data.data
}

await fetchUser(route.params.id)

useMeta().setTitle(user.value.name)
</script>

<template>
  <div class="pt-10">
    <div class="flex items-center mb-10">
      <div class="mr-10 w-32">
        <img :src="UserDefaultAvatar" :alt="user.name" />
      </div>
      <div>
        <div class="mb-2 text-2xl">{{ user.name }}</div>
        <div class="flex items-start mb-3 text-sm text-secondary" :title="user.verified ? 'Verified' : 'Unverified'">
          <span v-if="user.email">{{ user.email }}</span>
          <span v-else>email hidden</span>
          <font-awesome-icon v-if="user.verified" icon="check-double" class="ml-2 text-sm text-primary" />
        </div>
        <div>Registered {{ $date.formatDate(user.registered_at) }} ({{ $date.ago(user.registered_at) }})</div>
      </div>
    </div>
    <div>Reviews: {{ user.reviews_count || 0 }}</div>
    <div>Wishlist: {{ user.wishlist_count || 0 }}</div>
  </div>
</template>
