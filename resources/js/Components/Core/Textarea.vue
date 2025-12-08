<template>
  <PrimeTextarea v-model="modelValue" :id :disabled />
</template>

<script lang="ts" setup>
import PrimeTextarea from "primevue/textarea";

const modelValue = defineModel<string | null>();

const props = withDefaults(
  defineProps<{
    id?: string;
    disabled?: boolean;
  }>(),
  {
    disabled: false,
  }
);
</script>
