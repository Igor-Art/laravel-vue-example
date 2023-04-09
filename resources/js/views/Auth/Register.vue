<script setup>
import { Form, Field, ErrorMessage, Yup } from '@/form'
import { useAuthStore } from '@/stores/auth'
import AuthCard from '@/components/Auth/Card.vue'
import { RouterLink } from 'vue-router'

const schema = Yup.object().shape({
  email: Yup.string().required().email(),
  name: Yup.string().required().max(50),
  password: Yup.string().required().min(6),
  password_confirmation: Yup.string().required().oneOf([Yup.ref('password'), null], 'Passwords must match'),
})

async function onSubmit (values) {
  const authStore = useAuthStore()

  await authStore.register(values)
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
        <Field name="name" placeholder="Name" type="text" class="input" :class="{ 'has-error': errors.name }" />
        <ErrorMessage name="name" class="error-message" />
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
        <RouterLink :to="{ name: 'auth.login' }" class="mr-5 text-secondary">Already?</RouterLink>
        <button :disabled="isSubmitting" class="px-1 border-b border-white border-opacity-75">
          Register
        </button>
      </div>
    </Form>
  </AuthCard>
</template>
