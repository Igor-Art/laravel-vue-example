<script setup>
import { RouterLink } from 'vue-router'
import { Form, Field, ErrorMessage, Yup } from '@/form'
import { useAuthStore } from '@/stores/auth'
import AuthCard from '@/components/Auth/Card.vue'

const schema = Yup.object().shape({
  email: Yup.string().required().email(),
})

async function onSubmit (values) {
  const authStore = useAuthStore()

  await authStore.forgot(values)
}
</script>

<template>
  <AuthCard class="mx-auto mt-24">
    <Form v-slot="{ errors, isSubmitting }" :validation-schema="schema" @submit="onSubmit">
      <div class="input-row">
        <Field name="email" placeholder="Email" type="text" class="input" :class="{ 'has-error': errors.email }" />
        <ErrorMessage name="email" class="error-message" />
      </div>
      <div class="mt-6 text-right">
        <RouterLink :to="{ name: 'auth.login' }" class="mr-5 text-secondary">Back to login</RouterLink>
        <button :disabled="isSubmitting" class="px-1 border-b border-white border-opacity-75">
          Reset password
        </button>
      </div>
    </Form>
  </AuthCard>
</template>
