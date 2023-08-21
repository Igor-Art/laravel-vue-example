<script setup>
import { Form, Field, ErrorMessage, Yup } from '@/form'
import { useModal } from '@/stores/modals'
import Modal from '@/components/Modals/Modal.vue'
import http from '@/http'

const emit = defineEmits(['confirmed', 'cancel'])

const confirmModal = useModal()

const schema = Yup.object().shape({
  password: Yup.string().required(),
})

function confirming() {
  http.get('auth/user/confirmed-password-status')
    .then((response) => {
      if (response.data.confirmed) {
        emit('confirmed')
      } else {
        confirmModal.open()
      }
    })
}

function cancel() {
  confirmModal.close()
}

function onSubmit({ password }) {
  http.post('auth/user/confirm-password', { password })
    .then(() => {
      confirmModal.close()
      emit('confirmed')
    })
}
</script>

<template>
  <span @click="confirming">
    <slot />
  </span>

  <Modal :modal="confirmModal">
    <template #header>
      <font-awesome-icon icon="lock" class="mr-2" />
      Enter password to confirm action
    </template>
    <Form v-slot="{ errors, isSubmitting }" :validation-schema="schema" @submit="onSubmit">
      <div class="input-row">
        <Field
          type="password"
          name="password"
          class="input"
          :class="{ 'has-error': errors.password }"
          placeholder="Password"
          autocomplete="off"
        />
        <ErrorMessage name="password" class="error-message" />
      </div>
      <div class="flex justify-end">
        <button type="button" class="button default mr-6" @click="cancel">
          Cancel
        </button>
        <button :disabled="isSubmitting" class="button primary">
          Confirm
        </button>
      </div>
    </Form>
  </Modal>
</template>
