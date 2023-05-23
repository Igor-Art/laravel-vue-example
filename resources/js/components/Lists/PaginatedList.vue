<script setup>
import { watch } from 'vue'
import { useRoute } from 'vue-router'
import NumberPagination from '@/components/Pagination/NumberPagination.vue'
import LoadMorePagination from '@/components/Pagination/LoadMorePagination.vue'

const emit = defineEmits(['changed'])
const route = useRoute()

const props = defineProps({
  component: {
    type: Object,
    required: true,
  },
  items: {
    type: Array,
    required: true,
  },
  meta: {
    type: Object,
    required: true,
  },
  itemKey: {
    type: String,
    required: false,
    default: 'id',
  },
  itemPropName: {
    type: String,
    required: true,
  },
  bagName: {
    type: String,
    required: false,
    default: 'page',
  },
  classPagination: {
    type: String,
    required: false,
    default: '',
  },
  classItem: {
    type: String,
    required: false,
    default: '',
  },
  scopeRoute: {
    type: String,
    required: false,
    default: '',
  },
  isLoading: {
    type: Boolean,
    required: false,
    default: false,
  },
})

const isCursor = typeof props.meta.next_cursor !== 'undefined'

const itemProps = (item) => ({
  [props.itemPropName]: item
})

const emitChanged = () => {
  emit('changed', {
    [isCursor ? 'cursor' : props.bagName]: isCursor ? props.meta.next_cursor : route.query[props.bagName],
  })
}

if (!isCursor) {
  watch(() => route.query[props.bagName], () => {
    if (!props.scopeRoute || route.name === props.scopeRoute) {
      emitChanged()
    }
  })
}
</script>

<template>
  <div :class="$attrs.class">
    <Component
      v-for="item in items"
      v-bind="itemProps(item)"
      :key="item[itemKey]"
      :class="classItem"
      :is="component"
    />
  </div>
  <LoadMorePagination
    v-if="isCursor && meta.next_cursor"
    :disabled="isLoading"
    :class="classPagination"
    @demanded="emitChanged"
  />
  <NumberPagination
    v-if="!isCursor"
    :per="meta.per_page"
    :total="meta.total"
    :name="bagName"
    :class="classPagination"
  />
</template>
