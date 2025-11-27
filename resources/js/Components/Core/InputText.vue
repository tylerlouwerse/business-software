<template>
  <PrimeInputText v-model="modelValue" :id :disabled />
</template>

<script lang="ts" setup>
import PrimeInputText from "primevue/inputtext";

const modelValue = defineModel<string | null>();

withDefaults(
  defineProps<{
    id?: string;
    disabled?: boolean;
  }>(),
  {
    disabled: false,
  }
);
</script>
