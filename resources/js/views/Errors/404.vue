<script setup>
import Headline from '@/components/Headline.vue'
import { useMeta } from '@/plugins/meta'

useMeta().setTitle('404')
</script>

<template>
  <div class="flex items-center">
    <Headline class="mr-8">404 Not Found</Headline>
      <pre class="whitespace-pre-wrap">
  ／l、
（ﾟ､ ｡７
  l、ﾞ~ヽ
  じしf_,)ノ</pre>
  </div>
</template>
