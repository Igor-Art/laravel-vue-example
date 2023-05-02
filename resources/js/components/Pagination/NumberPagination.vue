<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()

const props = defineProps({
  total: {
    type: Number,
    required: true,
  },
  per: {
    type: Number,
    required: true,
  },
  name: {
    type: String,
    default: 'page',
    required: false,
  },
})

const current = computed(() => +route.query[props.name] || 1)
const lastPage = computed(() => Math.ceil(props.total / props.per))
const prevPage = computed(() => current.value > 1 ? current.value - 1 : 1)
const nextPage = computed(() => current.value < lastPage.value ? current.value + 1 : lastPage.value)

const getLink = (num) => {
  const options = {
    name: route.name,
    query: Object.assign({}, route.query || {})
  }

  options.query[props.name] = num

  return options
}
</script>

<template>
  <div v-if="lastPage > 1" class="pagination">
    <RouterLink v-if="current !== 1" :to="getLink(prevPage)" class="item">&lt;</RouterLink>

    <RouterLink v-if="current !== 1" :to="getLink(1)" class="item">1</RouterLink>
    <span v-else class="item current">1</span>

    <RouterLink v-if="current === 1 && lastPage > 2" :to="getLink(2)" class="item">2</RouterLink>

    <span v-if="current > 2" class="item separator">...</span>

    <span v-if="current > 1 && current < lastPage" class="item current">{{ current }}</span>

    <span v-if="current < lastPage - 1" class="item separator">...</span>

    <RouterLink v-if="current === lastPage && lastPage - 1 > 1" :to="getLink(lastPage - 1)" class="item">{{ lastPage - 1 }}</RouterLink>

    <RouterLink v-if="current !== lastPage" :to="getLink(lastPage)" class="item">{{ lastPage }}</RouterLink>
    <span v-else class="item current">{{ lastPage }}</span>

    <RouterLink v-if="current !== lastPage" :to="getLink(nextPage)" class="item">&gt;</RouterLink>
  </div>
</template>

<style scoped>
.pagination {
  @apply flex;
}

.pagination.left {
  @apply justify-start;
}
.pagination.center {
  @apply justify-center;
}
.pagination.right {
  @apply justify-end;
}

.pagination .item {
  @apply block w-8 border border-white border-opacity-50 rounded leading-8 text-center;
}

.pagination .item:not(:last-child) {
  @apply mr-2;
}

.pagination a.item:hover {
  @apply border-opacity-70 text-white bg-sky-300 bg-opacity-20;
}

.pagination .item.current {
  @apply bg-sky-300 bg-opacity-30;
}

.pagination .item.separator {
  @apply border-white border-opacity-20 text-white text-opacity-60;
}

.pagination .item.current,
.pagination .item.separator {
  @apply select-none;
}
</style>
