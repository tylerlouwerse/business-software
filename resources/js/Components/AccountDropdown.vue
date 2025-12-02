<template>
  <Tooltip message="Account" placement="bottom" remove-arrow>
    <OverlayPanel sharp>
      <template #trigger>
        <div
          class="flex h-[35px] w-[35px] cursor-pointer items-center justify-center rounded-full transition duration-150 hover:bg-primary-800 active:bg-primary-600"
        >
          <div
            class="flex h-[25px] w-[25px] items-center justify-center rounded-full bg-stone-200"
          >
            <span class="text-sm font-bold text-stone-900">TL</span>
          </div>
        </div>
      </template>
    </OverlayPanel>
  </Tooltip>
</template>

<script lang="ts" setup>
import { OverlayPanel, Tooltip } from "@/Components/Core";
</script>
