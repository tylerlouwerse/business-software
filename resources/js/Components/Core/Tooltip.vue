<template>
  <div
    class="tooltip-wrapper"
    @mouseenter="handleSetHover(true)"
    @mouseleave="handleSetHover(false)"
  >
    <div ref="reference" :class="referenceContainerClasses">
      <slot />
    </div>
    <div
      v-if="show"
      ref="floating"
      class="tooltip"
      :class="variantClass"
      :style="floatingStyles"
      @mouseenter="handleSetHover(true)"
      @mouseleave="handleSetHover(false)"
    >
      <div ref="floatingContent" class="overflow-y-auto">
        <slot name="tooltip">
          {{ message }}
        </slot>
      </div>
      <div
        v-if="!removeArrow"
        ref="tooltipArrow"
        class="arrow"
        :class="variantClass"
        :style="arrowStyles"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onBeforeUnmount } from "vue";
import {
  useFloating,
  autoUpdate,
  flip,
  size,
  shift,
  limitShift,
  arrow,
  offset,
} from "@floating-ui/vue";
import { debounce } from "lodash";

const props = defineProps({
  placement: { type: String, default: "top" },
  offset: { type: Number, default: 5 },
  show: { type: Boolean, default: true },
  variant: { type: String, default: "dark" },
  message: { type: String, default: "" },
  delay: { type: Number, default: 0 },
  appendToBody: { type: Boolean, default: false },
  referenceContainerClasses: { type: String, default: "w-fit h-fit" },
  removeArrow: { type: Boolean, default: false },
});

const appendedToBody = ref(false);
const reference = ref(null);
const floating = ref(null);
const floatingContent = ref(null);
const tooltipArrow = ref(null);

const hover = ref(false);

const show = computed(() => props.show && hover.value);

const middleware = ref([
  offset(props.offset),
  flip({ padding: 15 }),
  shift({ limiter: limitShift() }),
  size({
    padding: 15,
    apply({ availableHeight }) {
      Object.assign(floatingContent.value.style, {
        maxHeight: `${availableHeight}px`,
      });
    },
  }),
  arrow({ element: tooltipArrow }),
]);

const { floatingStyles, placement, middlewareData } = useFloating(
  reference,
  floating,
  {
    placement: props.placement,
    middleware,
    whileElementsMounted: autoUpdate,
  }
);

const arrowStyles = computed(() => {
  const arrow = middlewareData.value.arrow;

  const x = arrow?.x ? `${arrow.x}px` : "";
  const y = arrow?.y ? `${arrow.y}px` : "";

  const staticSide = {
    top: "bottom",
    right: "left",
    bottom: "top",
    left: "right",
  }[placement.value.split("-")[0]];

  return {
    left: x,
    top: y,
    right: "",
    bottom: "",
    [staticSide]: "-3px",
  };
});

const variantClass = computed(() => {
  return {
    dark: "tooltip-dark",
    light: "tooltip-light",
  }[props.variant];
});

// this debounce makes it much easier for the
// user's cursor to move from the reference to
// the tooltip without the tooltip disappearing
const handleSetHover = debounce((value) => {
  hover.value = value;
}, 100);

watch(floating, () => {
  if (props.appendToBody && !appendedToBody.value && floating.value) {
    document.getElementsByTagName("body")[0].append(floating.value);
    appendedToBody.value = true;
  }
});

onBeforeUnmount(() => {
  if (props.appendToBody && floating.value) {
    floating.value.remove();
  }
});
</script>

<style scoped>
.tooltip-wrapper {
  cursor: pointer;
}

.tooltip {
  width: max-content;
  position: absolute;
  top: 0;
  left: 0;
  font-size: 0.7rem;
  line-height: 1rem;
  z-index: 150;
  padding: 2px 4px;
  border-radius: 5px;
  text-align: center;
}

.tooltip-light {
  background: white;
  border-bottom: 1px solid #ddd;
  border-left: 1px solid #ddd;
  border-right: 1px solid #ddd;
  color: #222;
}

.tooltip-dark {
  background: #222;
  color: white;
}

.tooltip-clear {
  background: transparent;
  color: inherit;
}

.arrow {
  position: absolute;
  width: 6px;
  height: 6px;
  transform: rotate(45deg);
}
</style>
