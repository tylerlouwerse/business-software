<template>
  <InertiaLink :href :class="classes">
    <slot />
  </InertiaLink>
</template>

<script lang="ts" setup>
import { computed } from "vue";
import { Link as InertiaLink } from "@inertiajs/vue3";

const props = withDefaults(
  defineProps<{
    href: string;
    unstyled?: boolean;
  }>(),
  {
    unstyled: false,
  }
);

const classes = computed(() => {
  if (props.unstyled) return "";

  return "font-medium text-primary-600 hover:text-primary-500";
});
</script>
