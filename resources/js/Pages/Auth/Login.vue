<template>
  <Head title="Login" />
  <div
    class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-md w-full space-y-8">
      <div>
        <h2 class="mt-8 text-center text-3xl font-extrabold text-gray-900">
          Sign in to your account
        </h2>
      </div>
      <form
        @submit.prevent="submit"
        class="mt-6 space-y-6 shadow-sm p-6 rounded-lg bg-white"
      >
        <div
          v-if="form.errors.email || form.errors.password"
          class="rounded-md bg-red-50 p-4"
        >
          <div class="text-sm text-red-700">
            {{ error }}
          </div>
        </div>

        <div class="rounded-md space-y-4">
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
          <div>
            <label for="password" class="sr-only">Password</label>
            <InputText
              id="password"
              v-model="form.password"
              class="w-full"
              type="password"
              autocomplete="current-password"
              placeholder="Password"
            />
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <Checkbox id="remember-me" v-model="form.remember" />
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
              Remember me
            </label>
          </div>

          <div class="text-sm">
            <Link
              href="/forgot-password"
              class="font-medium text-primary-600 hover:text-primary-500"
            >
              Forgot your password?
            </Link>
          </div>
        </div>

        <div>
          <Button class="w-full" type="submit" :disabled="form.processing">
            <span v-if="form.processing">Signing in...</span>
            <span v-else>Sign in</span>
          </Button>
        </div>
      </form>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import Head from "@/Components/Head.vue";
import { Button, Checkbox, InputText, Link } from "@/Components/Core";

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const error = computed<string>(() => {
  if (form.errors.email) {
    return form.errors.email;
  }

  if (form.errors.password) {
    return form.errors.password;
  }

  return "";
});

const submit = () => {
  form.post("/login", {
    onFinish: () => form.reset("password"),
  });
};
</script>
