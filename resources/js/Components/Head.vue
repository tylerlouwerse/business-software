<template>
  <InertiaHead :title />
</template>

<script lang="ts" setup>
import { Head as InertiaHead } from "@inertiajs/vue3";

defineProps<{
  title: string;
}>();
</script>
