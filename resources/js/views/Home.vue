<script setup>
import GamesTopSection from '@/components/Home/GamesTopSection.vue'
import ReviewsLastSection from '@/components/Home/ReviewsLastSection.vue'
import Headline from '@/components/Headline.vue'
import { useSettingsStore } from '@/stores/settings'

const settings = useSettingsStore()
</script>

<template>
  <div>
    <div class="mb-6">
      <Headline icon="code">Disclaimer</Headline>
      <div class="pl-2 leading-6 font-light">
        <p>
          Welcome to the Laravel+Vue example close to a real SPA-API application.
        </p>
        <p>
          Designed for junior developers, show the main points of full stack developing
          a classic web app with Auth, Roles, CRUD, Service Layer, etc.
        </p>
        <p>
          Your application may have a different implementation.
          Use any code of the app at your own risk 😈.
        </p>
        <p>
          You can make a suggestion or fix something in a
          <a
            :href="settings.github"
            target="_blank"
            rel="nofollow noopener noreferrer"
            class="text-sky-300 hover:text-app-secondary"
          >
            GitHub
          </a>.
          Enjoy!
        </p>
      </div>
    </div>
    <div class="mb-6">
      <GamesTopSection />
    </div>
    <div class="mb-10">
      <ReviewsLastSection />
    </div>
  </div>
</template>
