<template>
  <Head title="404" />
  <div
    class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-md w-full space-y-8 text-center">
      <div>
        <h1 class="text-9xl font-extrabold text-gray-900">404</h1>
        <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
          Page not found
        </h2>
        <p class="mt-4 text-sm text-gray-600">
          Sorry, we couldn't find the page you're looking for.
        </p>
      </div>
      <div>
        <Link
          :href="route('dashboard')"
          class="inline-flex items-center font-medium text-primary-600 hover:text-primary-500"
        >
          Go back to dashboard
        </Link>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import Head from "@/Components/Head.vue";
import { Link } from "@/Components/Core";
import { route } from "@/Utils/route";
</script>
