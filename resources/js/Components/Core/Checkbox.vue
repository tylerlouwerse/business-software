<template>
  <PrimeCheckbox v-model="modelValue" binary @change="emit('change', $event)" />
</template>

<script lang="ts" setup>
import PrimeCheckbox from "primevue/checkbox";

const modelValue = defineModel<boolean | null>();

const emit = defineEmits<{
  (e: "change", event: Event): void;
}>();
</script>
