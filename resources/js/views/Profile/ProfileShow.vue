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
    <div class="flex items-start mb-10">
      <div class="profile-sidebar">
        <RouterLink
          :to="{ name: 'profile.show.reviews' }"
          class="item"
          :class="{ disabled: !user.reviews_count }"
        >
          Reviews ({{ user.reviews_count || 0 }})
        </RouterLink>
        <RouterLink
          :to="{ name: 'profile.show.wishlist' }"
          class="item"
          :class="{ disabled: !user.wishlist_count }"
        >
          Wishlist ({{ user.wishlist_count || 0 }})
        </RouterLink>
      </div>
      <div class="pt-4 flex-grow">
        <RouterView />
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.profile-sidebar {
  @apply flex flex-col mr-10 w-32 border-white border-opacity-20;
  > .item {
    @apply block py-2 px-4 text-sm transition;
    @apply border border-transparent border-r-white border-opacity-20;

    &:not(:first-child) {
      position: relative;
      margin-top: -1px;
    }

    &:hover,
    &.router-link-exact-active {
      @apply border-white border-opacity-20;
    }
    &.router-link-exact-active {
      @apply border-r-0;
    }

    &.disabled {
      @apply pointer-events-none text-primary text-opacity-30;
    }
  }
}
</style>
