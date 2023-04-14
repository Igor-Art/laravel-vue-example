<script setup>
import GamesTopSection from '@/components/Home/GamesTopSection.vue'
import ReviewsLastSection from '@/components/Home/ReviewsLastSection.vue'
import Headline from '@/components/Headline.vue'
</script>

<template>
  <div class="mb-10">
    <Headline icon="code">Disclaimer</Headline>
    <div class="pl-2 leading-6 font-light">
      <p>
        Welcome to the Laravel-Vue example application.
        This is not a realistic, but close to reality SPA-API app.
      </p>
      <p>
        Designed for junior developers, show the main points of developing
        a classic web app with Auth, Roles, CRUD, Service Layer, etc.
      </p>
      <p>
        Your application may have a different implementation.
        Use any code of the app at your own risk 😈.
      </p>
      <p>
        You can make a suggestion or fix something in a github issue. Enjoy!
      </p>
    </div>
  </div>
  <div class="mb-6">
    <GamesTopSection />
  </div>
  <div class="mb-10">
    <ReviewsLastSection />
  </div>
</template>
