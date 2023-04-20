<script setup>
import { RouterLink, useRoute } from 'vue-router'
import { Form, Field, ErrorMessage, Yup } from '@/form'
import { useAuthStore } from '@/stores/auth'
import AuthCard from '@/components/Auth/AuthCard.vue'

const route = useRoute()

const schema = Yup.object().shape({
  password: Yup.string().required().min(6),
  password_confirmation: Yup.string().required().oneOf([Yup.ref('password'), null], 'Passwords must match'),
})

async function onSubmit (values) {
  const authStore = useAuthStore()

  values.token = route.params.token
  values.email = route.query.email

  await authStore.resetPassword(values)
}
</script>

<template>
  <AuthCard class="mx-auto mt-24">
    <Form v-slot="{ errors, isSubmitting }" :validation-schema="schema" @submit="onSubmit">
      <div class="mb-5">
        Enter a new password for <span class="italic whitespace-nowrap">{{ $route.query.email }}</span>
      </div>
      <div class="input-row">
        <Field name="password" placeholder="Password" type="password" class="input" :class="{ 'has-error': errors.password }" />
        <ErrorMessage name="password" class="error-message" />
      </div>
      <div class="input-row">
        <Field name="password_confirmation" placeholder="Confirm password" type="password" class="input" :class="{ 'has-error': errors.password_confirmation }" />
        <ErrorMessage name="password_confirmation" class="error-message" />
      </div>
      <div class="mt-6 text-right">
        <RouterLink :to="{ name: 'auth.login' }" class="mr-5 text-secondary">Back to login</RouterLink>
        <button :disabled="isSubmitting" class="button default">
          Reset password
        </button>
      </div>
    </Form>
  </AuthCard>
</template>
