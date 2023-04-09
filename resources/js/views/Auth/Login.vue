<script setup>
import { RouterLink } from 'vue-router'
import { Form, Field, ErrorMessage, Yup } from '@/form'
import { useAuthStore } from '@/stores/auth'
import AuthCard from '@/components/Auth/Card.vue'

const schema = Yup.object().shape({
  email: Yup.string().required().email(),
  password: Yup.string().required(),
})

async function onSubmit (values) {
  const authStore = useAuthStore()

  await authStore.login(values)
}
</script>

<template>
  <AuthCard class="mx-auto mt-24">
    <Form v-slot="{ errors, isSubmitting }" :validation-schema="schema" @submit="onSubmit">
      <div class="input-row">
        <Field name="email" placeholder="Email" type="text" class="input" :class="{ 'has-error': errors.email }" />
        <ErrorMessage name="email" class="error-message" />
      </div>
      <div class="input-row">
        <Field name="password" placeholder="Password" type="password" class="input" :class="{ 'has-error': errors.password }" />
        <ErrorMessage name="password" class="error-message" />
      </div>
      <div class="mt-6">
        <div class="flex justify-between">
          <div>
            <RouterLink :to="{ name: 'auth.forgot' }" class="mr-5 text-secondary">Forgot?</RouterLink>
          </div>
          <div class="text-right">
            <RouterLink :to="{ name: 'auth.register' }" class="mr-5 text-secondary">Register</RouterLink>
            <button :disabled="isSubmitting" class="button default">
              Login
            </button>
          </div>
        </div>
      </div>
    </Form>
  </AuthCard>
</template>
