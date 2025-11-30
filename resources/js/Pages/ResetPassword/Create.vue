<template>
  <Head title="Reset Password" />
  <div
    class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-md w-full space-y-8">
      <div>
        <h2 class="mt-8 text-center text-3xl font-extrabold text-gray-900">
          Reset your password
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Enter your email address and we'll send you a link to reset your
          password.
        </p>
      </div>
      <form
        @submit.prevent="submit"
        class="mt-6 space-y-6 shadow-sm p-6 rounded-lg bg-white"
      >
        <div v-if="form.errors.email" class="rounded-md bg-red-50 p-4">
          <div class="text-sm text-red-700">
            {{ form.errors.email }}
          </div>
        </div>

        <div class="rounded-md">
          <div>
            <label for="email" class="sr-only">Email address</label>
            <InputText
              id="email"
              v-model="form.email"
              class="w-full"
              type="email"
              autocomplete="email"
              placeholder="Email address"
            />
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="text-sm">
            <Link
              :href="route('login')"
              class="font-medium text-primary-600 hover:text-primary-500"
            >
              Back to login
            </Link>
          </div>
        </div>

        <div>
          <Button class="w-full" type="submit" :disabled="form.processing">
            <span v-if="form.processing">Sending...</span>
            <span v-else>Send reset link</span>
          </Button>
        </div>
      </form>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import Head from "@/Components/Head.vue";
import { Button, InputText, Link } from "@/Components/Core";
import { route } from "@/Utils/route";

const props = defineProps<{
  email?: string;
}>();

const form = useForm({
  email: props.email || "",
});

const submit = () => {
  form.post(route("password-reset.store"));
};
</script>
