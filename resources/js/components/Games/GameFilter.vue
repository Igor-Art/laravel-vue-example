<script setup>
import VueMultiselect from 'vue-multiselect'
import Toggle from '@vueform/toggle'
import http from '@/http'
import { useGameFilterStore } from '@/stores/game-filter'
import { ref } from 'vue'

const filterStore = useGameFilterStore()

const genres = ref([])

const fetchGenres = async () => {
  const response = await http.get('api/genres')

  genres.value = response.data.data
}

fetchGenres()
</script>

<template>
  <div>
    <div class="w-96 mb-3">
      <VueMultiselect
        v-model="filterStore.genres"
        :options="genres"
        :multiple="true"
        :searchable="false"
        :close-on-select="false"
        track-by="id"
        label="title"
        placeholder="Choose genres"
      />
    </div>
    <div class="w-96 mb-5">
      <input v-model="filterStore.search" type="search" class="input" placeholder="Search" />
    </div>
    <div class="mb-3">
      <Toggle
        v-model="filterStore.is_free"
        offLabel="FREE"
        onLabel="FREE"
      />
    </div>
  </div>
</template>

<style>
@import 'vue-multiselect/dist/vue-multiselect.css';
@import '@vueform/toggle/themes/default.css';

:root {
  --toggle-width: 5.8rem;
  --toggle-height: 1.75rem;
  --toggle-bg-on: theme('colors.green.500');
  --toggle-bg-off: #c2ced5;
  --toggle-ring-width: 2px;
  --toggle-ring-color: theme('colors.sky.300/10%');
}

.input[type="search"] {
  min-height: 40px;
}

.multiselect {
  @apply text-primary;
}
.multiselect__tags {
  @apply pt-2 bg-transparent border border-white border-opacity-50 rounded;
}
.multiselect__option--selected {
  @apply text-primary;
}
.multiselect__option--selected.multiselect__option--highlight {
  @apply bg-sky-500;
}
.multiselect__tag {
  @apply bg-sky-600;
}
.multiselect__tag-icon::after {
  @apply text-sky-900;
}
.multiselect__placeholder {
  @apply text-white text-opacity-50;
}
.multiselect__content-wrapper {
  @apply border-white border-opacity-50;
}
.multiselect__content-wrapper,
.multiselect__option--selected {
  @apply bg-[#003362];
}
.multiselect--active .multiselect__placeholder {
  /* fix height jumps when switching */
  @apply inline-block invisible;
}
.multiselect__option--selected::after {
  @apply text-yellow-200 font-normal;
}
</style>
