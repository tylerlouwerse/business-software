<template>
  <Head title="App Setup" />
  <div
    class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-md w-full space-y-8">
      <div>
        <h2 class="mt-8 text-center text-3xl font-extrabold text-gray-900">
          App Setup
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Create your first admin account to get started
        </p>
      </div>
      <form
        @submit.prevent="submit"
        class="mt-6 space-y-6 shadow-sm p-6 rounded-lg bg-white"
      >
        <div v-if="hasErrors" class="rounded-md bg-red-50 p-4">
          <div class="text-sm text-red-700">
            {{ errorMessage }}
          </div>
        </div>

        <div class="rounded-md space-y-4">
          <div>
            <label for="name" class="sr-only">Name</label>
            <InputText
              id="name"
              v-model="form.name"
              class="w-full"
              type="text"
              autocomplete="name"
              placeholder="Name"
            />
            <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">
              {{ form.errors.name }}
            </p>
          </div>
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
            <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">
              {{ form.errors.email }}
            </p>
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <InputText
              id="password"
              v-model="form.password"
              class="w-full"
              type="password"
              autocomplete="new-password"
              placeholder="Password"
            />
            <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">
              {{ form.errors.password }}
            </p>
          </div>
          <div>
            <label for="password_confirmation" class="sr-only"
              >Confirm Password</label
            >
            <InputText
              id="password_confirmation"
              v-model="form.password_confirmation"
              class="w-full"
              type="password"
              autocomplete="new-password"
              placeholder="Confirm Password"
            />
            <p
              v-if="form.errors.password_confirmation"
              class="mt-1 text-sm text-red-600"
            >
              {{ form.errors.password_confirmation }}
            </p>
          </div>
        </div>

        <div>
          <Button class="w-full" type="submit" :disabled="form.processing">
            <span v-if="form.processing">Setting up...</span>
            <span v-else>Complete Setup</span>
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
import { Button, InputText } from "@/Components/Core";
import { route } from "@/Utils/route";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const hasErrors = computed<boolean>(() => {
  return !!(
    form.errors.name ||
    form.errors.email ||
    form.errors.password ||
    form.errors.password_confirmation
  );
});

const errorMessage = computed<string>(() => {
  if (form.errors.name) {
    return form.errors.name;
  }
  if (form.errors.email) {
    return form.errors.email;
  }
  if (form.errors.password) {
    return form.errors.password;
  }
  if (form.errors.password_confirmation) {
    return form.errors.password_confirmation;
  }
  return "";
});

const submit = () => {
  form.post(route("setup.admin.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>
