<script setup>
import { ref } from 'vue'
import { useToast } from 'vue-toastification'
import { Form, Field, ErrorMessage, Yup } from '@/form'
import http from '@/http'
import RatingConfig from '@/config/rating'
import RatingInput from '@/components/Rating/RatingInput.vue'

const emit = defineEmits(['reviewCreated'])

const props = defineProps({
  game: {
    type: Object,
    required: true,
  }
})

const toast = useToast()
const rating = ref(0)

const schema = Yup.object().shape({
  rating: Yup.number().required().min(1).max(RatingConfig.max),
  content: Yup.string().required().max(1000),
})

async function onSubmit (values, { resetForm }) {
  const response = await http.post('/api/reviews', {
    game_id: props.game.id,
    rating: values.rating,
    content: values.content,
  })

  if (response.status === 200) {
    toast.success(response.data.message)
    resetForm()
    emit('reviewCreated')
  }
}
</script>

<template>
  <div>
    <Form v-slot="{ errors, isSubmitting }" :validation-schema="schema" @submit="onSubmit">
      <div class="input-row">
        <Field name="rating" type="hidden" v-model="rating"/>
        <RatingInput v-model="rating" :max="RatingConfig.max" />
        <ErrorMessage name="rating" class="error-message" />
      </div>
      <div class="input-row">
        <Field
          name="content"
          as="textarea"
          class="input"
          :class="{ 'has-error': errors.content }"
          placeholder="You review..."
        />
        <ErrorMessage name="content" class="error-message" />
      </div>
      <div class="input-row text-right">
        <button :disabled="isSubmitting" class="button default">Create</button>
      </div>
    </Form>
  </div>
</template>
