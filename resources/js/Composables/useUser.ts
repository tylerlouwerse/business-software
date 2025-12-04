import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

export const useUser = () => {
  const { props } = usePage<Inertia.PageProps>();

  const user = computed(() => {
    return props.user;
  });

  return {
    user,
  };
};
