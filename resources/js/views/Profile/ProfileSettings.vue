<script setup>
import { useMeta } from '@/plugins/meta'
import Panel from '@/components/Panel.vue'
import Headline from '@/components/Headline.vue'
import SettingsTwoFactor from '@/views/Profile/Sections/Settings/SettingsTwoFactor.vue'

useMeta().setTitle('Settings')
</script>

<template>
  <div>
    <Headline icon="gear" class="!mb-10">Settings</Headline>
    <div class="flex">
      <div class="w-1/2 py-6 mr-6 text-base">Two Factor Authentication</div>
      <Panel class="w-full">
        <SettingsTwoFactor />
      </Panel>
    </div>
  </div>
</template>

<style scoped lang="scss">
</style>
