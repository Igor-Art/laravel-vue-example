<script setup>
import { ref } from 'vue'
import { Form, Field, ErrorMessage, Yup } from '@/form'
import { useAuthStore } from '@/stores/auth'
import AuthCard from '@/components/Auth/AuthCard.vue'
import { useMeta } from '@/plugins/meta'

const recovery = ref(false)

const schema = Yup.object().shape({
  code: Yup.string().nullable(),
  recovery_code: Yup.string().nullable(),
})

async function onSubmit (values) {
  const authStore = useAuthStore()

  await authStore.loginTwoFactor(values)
}

function toggleRecovery () {
  recovery.value ^= true
}

useMeta().setTitle('Login')
</script>

<template>
  <AuthCard class="mx-auto mt-24">
    <div v-if="recovery" class="mb-6">
      Please confirm access to your account by entering one of your emergency recovery codes.
    </div>
    <div v-else class="mb-6">
      Please confirm access to your account by entering the authentication code provided by your authenticator application.
    </div>
    <Form v-slot="{ errors, isSubmitting }" :validation-schema="schema" @submit="onSubmit">
      <div v-if="recovery" class="input-row">
        <Field name="recovery_code" placeholder="Recovery Code" type="text" class="input" :class="{ 'has-error': errors.recovery_code }" />
        <ErrorMessage name="recovery_code" class="error-message" />
      </div>
      <div v-else class="input-row">
        <Field name="code" placeholder="Code" type="text" class="input" :class="{ 'has-error': errors.code }" />
        <ErrorMessage name="code" class="error-message" />
      </div>
      <div class="mt-6">
        <div class="flex justify-between">
          <div>
            <button v-if="recovery" class="button default" @click.prevent="toggleRecovery">
              Use an authentication code
            </button>
            <button v-else class="button default" @click.prevent="toggleRecovery">
              Lost device? Recovery
            </button>
          </div>
          <div class="text-right">
            <button :disabled="isSubmitting" class="button default">
              Login
            </button>
          </div>
        </div>
      </div>
    </Form>
  </AuthCard>
</template>
