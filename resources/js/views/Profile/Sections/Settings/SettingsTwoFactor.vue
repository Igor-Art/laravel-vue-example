<script setup>
import { ref, computed } from 'vue'
import { ErrorMessage, Field, Form, Yup } from '@/form'
import http from '@/http'
import { useAuthStore } from '@/stores/auth'
import ConfirmAuthAction from '@/components/Auth/ConfirmAuthAction.vue'

const auth = useAuthStore()

const lockToggle = ref(false)
const confirming = ref(false)
const qrCode = ref(null)
const setupKey = ref(null)
const recoveryCodes = ref([])
const twoFactorEnabled = computed(() => !lockToggle.value && auth.isTwoFactor)

const schemaConfirmation = Yup.object().shape({
  code: Yup.string().required(),
})

function enableTwoFactor() {
  lockToggle.value = true

  http.post('/auth/user/two-factor-authentication')
    .then(() => {
      auth.refreshUser()
    })
    .then(() => Promise.all([
      showQrCode(),
      showSetupKey(),
      showRecoveryCodes(),
    ]))
    .then(() => {
      lockToggle.value = false
      confirming.value = true
    })
}

function disableTwoFactor() {
  lockToggle.value = true

  http.delete('/auth/user/two-factor-authentication')
    .then(() => {
      auth.refreshUser()
      lockToggle.value = false
      confirming.value = false
    })
}

function confirmTwoFactor ({ code }) {
  http.post('/auth/user/confirmed-two-factor-authentication', { code })
    .then(() => {
      auth.refreshUser()
      confirming.value = false
      qrCode.value = null
      setupKey.value = null
    })
}

function regenerateRecoveryCodes () {
  http.post('auth/user/two-factor-recovery-codes').then(() => showRecoveryCodes())
}

function showQrCode() {
  return http.get('auth/user/two-factor-qr-code')
    .then((response) => {
      qrCode.value = response.data.svg
    })
}

function showSetupKey () {
  return http.get('auth/user/two-factor-secret-key')
    .then((response) => {
      setupKey.value = response.data.secretKey
    })
}

function showRecoveryCodes () {
  return http.get('auth/user/two-factor-recovery-codes')
    .then((response) => {
      recoveryCodes.value = response.data
    })
}
</script>

<template>
  <div>
    <div v-if="twoFactorEnabled">
      <h3 v-if="!confirming" class="mb-6">
        You have <span class="text-green-300">enabled</span> two factor authentication.
      </h3>
      <h3 v-else class="mb-6">
        <span class="text-cyan-200">Finish enabling</span> two factor authentication.
      </h3>
      <div v-if="qrCode">
        <p v-if="confirming">
          To finish enabling two factor authentication,
          scan the following QR code using your phone's authenticator application
          or enter the setup key and provide the generated OTP code.
        </p>
        <p v-else>
          Two factor authentication is now enabled.
          Scan the following QR code using your phone's authenticator application or enter the setup key.
        </p>
        <div v-html="qrCode" class="mt-4 p-2 inline-block bg-white" />
        <div v-if="setupKey" class="mt-4 max-w-xl text-sm text-secondary">
          or Setup Key: <span v-html="setupKey"></span>
        </div>
        <div v-if="confirming" class="mt-4 mb-4">
          <Form v-slot="{ errors }" :validation-schema="schemaConfirmation" @submit="confirmTwoFactor">
            <div class="flex">
              <div class="input-row mr-2">
                <Field
                  type="text"
                  name="code"
                  class="input"
                  :class="{ 'has-error': errors.code }"
                  placeholder="Code"
                  autocomplete="one-time-code"
                  autofocus
                />
                <ErrorMessage name="code" class="error-message" />
              </div>
              <div>
                <button ref="confirmFormSubmitButton" type="submit" class="hidden"></button>
                <ConfirmAuthAction @confirmed="$refs.confirmFormSubmitButton.click()">
                  <button type="button" class="button success">Confirm Device</button>
                </ConfirmAuthAction>
              </div>
            </div>
          </Form>
        </div>
      </div>
      <div v-if="recoveryCodes.length > 0 && !confirming" class="mb-6">
        <p class="mt-4 max-w-xl text-sm text-secondary">
          Store these recovery codes in a secure password manager.
          They can be used to recover access to your account if your two factor authentication device is lost.
        </p>
        <div class="grid gap-1 max-w-xl mt-4 p-4 font-mono rounded-lg text-sm bg-black bg-opacity-10">
          <div v-for="code in recoveryCodes" :key="code">
            {{ code }}
          </div>
        </div>
      </div>
      <div class="flex">
        <ConfirmAuthAction v-if="recoveryCodes.length > 0 && !confirming" @confirmed="regenerateRecoveryCodes">
          <button class="button warning mr-3">Regenerate Recovery Codes</button>
        </ConfirmAuthAction>
        <ConfirmAuthAction v-if="recoveryCodes.length === 0 && !confirming" @confirmed="showRecoveryCodes">
          <button class="button primary mr-3">Show Recovery Codes</button>
        </ConfirmAuthAction>
        <ConfirmAuthAction @confirmed="disableTwoFactor">
          <button class="button danger mr-3">{{ confirming ? 'Cancel activation' : 'Disable Two Factor' }}</button>
        </ConfirmAuthAction>
      </div>
    </div>
    <div v-else>
      <p class="mb-4">
        You have <span class="text-pink-400">not enabled</span> two factor authentication.
      </p>
      <ConfirmAuthAction @confirmed="enableTwoFactor">
        <button class="button success">Enable Two Factor</button>
      </ConfirmAuthAction>
    </div>
  </div>
</template>
