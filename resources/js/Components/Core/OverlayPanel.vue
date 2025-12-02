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
      class="overlay-portion w-full rounded-sm shadow-lg"
      v-if="visible"
      :style="floatingStyles"
    >
      <slot />
    </div>
  </div>
</template>

<script lang="ts" setup>
import type { PropType } from "vue";
import { onMounted, onUnmounted, ref, watch } from "vue";
import type { Placement } from "@floating-ui/vue";
import { useFloating, flip } from "@floating-ui/vue";

const props = defineProps({
  disabled: {
    type: Boolean as PropType<boolean>,
    default: false,
  },
  overlayStyles: {
    type: String as PropType<string>,
    default: "",
  },
  placement: {
    type: String as PropType<Placement>,
    default: "bottom-start",
  },
});

const emit = defineEmits({
  open: () => true,
  close: () => true,
});

const trigger = ref<HTMLElement | null>(null);
const overlay = ref<HTMLElement | null>(null);

const panel = ref<HTMLElement | null>(null);
const visible = ref<boolean>(false);

const middleware = ref([flip()]);
const { floatingStyles } = useFloating(trigger, overlay, {
  placement: props.placement,
  middleware,
});

const clickOff = (event: Event) => {
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
  visible.value = true;
  emit("open");
};

const close = () => {
  visible.value = false;
  emit("close");
};

onMounted(() => {
  window.addEventListener("click", clickOff);
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
  toggle,
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
