<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  game: {
    type: Object,
    required: true,
  },
})

const getDefaultCover = () => {}
</script>

<template>
  <div
    class="game-card relative rounded"
    :style="{backgroundImage: 'url(' + (game.cover_url || getDefaultCover()) + ')'}"
    :title="game.title"
  >
    <RouterLink
      :to="{ name: 'games.show', params: { slug: game.slug } }"
      class="block absolute bottom-0 left-0 right-0 top-0 hover:text-primary"
    >
      <span class="block absolute bottom-0 left-0 right-0 py-1 px-2 rounded-b bg-indigo-900 text-xs translate-z-none">
        {{ game.title }}
      </span>
    </RouterLink>
    <div class="absolute top-0 left-0 right-0 flex flex-nowrap items-center justify-between rounded-t py-1 px-2 bg-black bg-opacity-40 translate-z-none">
      <div class="flex font-bold text-xs">
        <font-awesome-icon icon="star" class="mr-1" />
        <span>{{ game.rating || '--' }}</span>
      </div>
      <div class="flex">
        <font-awesome-icon icon="comments" class="mr-1" />
        <span>{{ game.reviews_count || 0 }}</span>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
$gutter: 10px;

@mixin setWidth($percentage) {
  $ratio: 55.5;

  padding-top: calc(($percentage - $gutter) + ($percentage - $gutter) / 100 * $ratio);
  width: calc($percentage - $gutter);
}

.game-card {
  @include setWidth(25%);

  margin: 0 calc($gutter / 2) $gutter;
  background: transparent top center no-repeat;
  background-size: 100% 100%;
  box-shadow: none;
  transform-origin: top;
  transform: perspective(1100px) rotateX(0deg);
  transition: all .25s;

  @media only screen and (min-width: 1024px) {
    @include setWidth(20%)
  }
  @media only screen and (min-width: 1280px) {
    @include setWidth(16.6%)
  }
  @media only screen and (min-width: 1536px) {
    @include setWidth(12.5%)
  }

  &:hover {
    box-shadow: 0 5px 10px rgba(0,0,0, .4);
    transform: perspective(1100px) rotateX(10deg);
    transition: all .5s;
    transition-delay: .1s;
    z-index: 10;
  }
}
</style>
