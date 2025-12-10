<template>
  <div class="base-overlay-panel" ref="panel">
    <div
      ref="trigger"
      class="static-portion"
      @click="toggle"
      @keypress="toggle"
    >
      <slot name="trigger" :visible="visible" />
    </div>

    <div
      ref="overlay"
      :class="unstyled ? '' : 'overlay-portion w-full rounded-sm shadow-lg'"
      v-if="visible"
      :style="floatingStyles"
    >
      <slot />
    </div>
  </div>
</template>

<script lang="ts" setup>
import { onMounted, onUnmounted, ref, watch } from "vue";
import type { Placement } from "@floating-ui/vue";
import { useFloating, flip, offset } from "@floating-ui/vue";

const visible = defineModel<boolean>("visible", { default: false });

const props = withDefaults(
  defineProps<{
    disabled?: boolean;
    overlayStyles?: string;
    placement?: Placement;
    unstyled?: boolean;
    offset?: number;
  }>(),
  {
    disabled: false,
    overlayStyles: "",
    placement: "bottom-start",
    unstyled: false,
    offset: 0,
  }
);

const emit = defineEmits({
  open: () => true,
  close: () => true,
});

const trigger = ref<HTMLElement | null>(null);
const overlay = ref<HTMLElement | null>(null);

const panel = ref<HTMLElement | null>(null);
const disableClickoff = ref<boolean>(true);

const middleware = ref([offset(props.offset), flip()]);
const { floatingStyles } = useFloating(trigger, overlay, {
  placement: props.placement,
  middleware,
});

const clickOff = (event: Event) => {
  if (disableClickoff.value) {
    disableClickoff.value = false;
    return;
  }

  if (event && !panel.value?.contains(event.target as Node)) {
    visible.value = false;
    emit("close");
  }
};

const toggle = (event: Event) => {
  if (props.disabled) {
    return;
  }

  // if the event is a keypress
  if (event.type === "keypress" && event instanceof KeyboardEvent) {
    // always toggle open if the panel is closed
    if (visible.value === false) {
      visible.value = true;
      return;
    }

    // only toggle closed if the key is escape
    if (event.key === "Escape") {
      visible.value = false;
      return;
    }

    return;
  }

  // else toggle the panel
  visible.value = !visible.value;
};

const open = () => {
  disableClickoff.value = true;

  visible.value = true;
  emit("open");

  setTimeout(() => {
    disableClickoff.value = false;
  }, 500);
};

const close = () => {
  visible.value = false;
  emit("close");
};

onMounted(() => {
  window.addEventListener("click", clickOff);

  setTimeout(() => {
    disableClickoff.value = false;
  }, 500);
});

onUnmounted(() => {
  window.removeEventListener("click", clickOff);
});

watch(
  () => props.disabled,
  () => {
    if (props.disabled) {
      close();
    }
  }
);

defineExpose({
  open,
  close,
});
</script>

<style scoped>
.base-overlay-panel {
  position: relative;
}

.static-portion {
  cursor: pointer;
}

.overlay-portion {
  width: max-content;
  min-width: 100%;
  position: absolute;
  background-color: white;
  border: solid 1px rgb(245, 245, 245);
  border-radius: 4px;
  z-index: 10;
  top: 0;
  right: 0;
}
</style>
