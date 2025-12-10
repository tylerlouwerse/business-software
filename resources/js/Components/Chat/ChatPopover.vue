<template>
  <OverlayPanel
    ref="overlayPanelRef"
    v-model:visible="open"
    placement="top-start"
    unstyled
    :offset="-29"
    disable-clickoff
  >
    <template #trigger>
      <div
        class="w-[300px] flex items-center justify-between border-r border-gray-200 h-[29px] hover:bg-gray-100 active:bg-gray-200"
      >
        <div class="flex items-center gap-x-2 px-2">
          <div
            class="flex h-[22px] w-[22px] items-center justify-center rounded-full bg-pink-200"
          >
            <span class="font-bold text-gray-500 text-xs">TM</span>
          </div>

          <div class="text-sm text-gray-500 font-semibold">Twyla Marsman</div>
        </div>
        <div class="px-2">
          <XMarkIcon
            @click.stop
            class="h-5 w-5 text-gray-400 hover:text-gray-500 cursor-pointer"
            @click="chat.closeChannel(props.channel)"
          />
        </div>
      </div>
    </template>

    <div
      class="bg-white rounded-t-lg w-[300px] h-[479px] shadow-[6px_-6px_12px_0_rgba(0,0,0,0.08),6px_0px_12px_0_rgba(0,0,0,0.06)]"
    >
      <!-- Header -->
      <div
        class="flex items-center justify-between gap-x-3 p-2 border-b border-gray-200"
      >
        <div>
          <div
            class="flex h-[25px] w-[25px] items-center justify-center rounded-full bg-pink-200"
          >
            <span class="font-bold text-gray-600 text-sm">TM</span>
          </div>
        </div>
        <div class="flex-1">
          <div class="text-xs text-gray-800 font-bold">Twyla Marsman</div>
          <div class="text-xs text-gray-400 leading-4">Engaged at work</div>
        </div>
        <div class="flex items-center gap-x-1">
          <div
            class="border border-gray-200 rounded-lg p-1 hover:bg-gray-100 active:bg-gray-200 cursor-pointer"
          >
            <PhoneIcon class="h-4 w-4 text-gray-400" />
          </div>
          <div
            class="border border-gray-200 rounded-lg p-1 hover:bg-gray-100 active:bg-gray-200 cursor-pointer"
            @click="open = false"
          >
            <MinusIcon class="h-4 w-4 text-gray-400" />
          </div>
          <div
            class="border border-gray-200 rounded-lg p-1 hover:bg-gray-100 active:bg-gray-200 cursor-pointer"
          >
            <ArrowsOutIcon class="h-4 w-4 text-gray-400" />
          </div>
          <div
            class="border border-gray-200 rounded-lg p-1 hover:bg-gray-100 active:bg-gray-200 cursor-pointer"
            @click="chat.closeChannel(props.channel)"
          >
            <XMarkIcon class="h-4 w-4 text-gray-400" />
          </div>
        </div>
      </div>

      <!-- Messages -->
      <div class="h-[calc(100%-125px)]"></div>

      <!-- Input -->
      <div class="px-2">
        <div class="flex justify-end mb-1">
          <div class="flex items-center gap-x-1 text-xs text-gray-600">
            <div>Actions</div>
            <ChevronDownIcon class="h-3 w-3" />
          </div>
        </div>
        <div class="relative">
          <div
            class="absolute top-px left-px bg-gray-100 rounded-l-lg p-1 h-[56px] w-[35px] flex items-center justify-center"
          >
            <AttachmentIcon class="h-5 w-5 text-gray-400" />
          </div>
          <Textarea
            autofocus
            class="w-full pl-[40px]! pr-[55px]! text-gray-600!"
            style="resize: none"
          />
          <div
            class="absolute top-px right-px h-[56px] flex items-center gap-x-2 pr-2"
          >
            <MicrophoneIcon class="h-5 w-5 text-gray-400" />
            <FaceSmileIcon class="h-5 w-5 text-gray-400" />
          </div>
        </div>
      </div>
    </div>
  </OverlayPanel>
</template>

<script lang="ts" setup>
import { OverlayPanel, Textarea } from "@/Components/Core";
import XMarkIcon from "@/../svg/x-mark.svg?component";
import MinusIcon from "@/../svg/minus.svg?component";
import ArrowsOutIcon from "@/../svg/arrows-out.svg?component";
import PhoneIcon from "@/../svg/phone.svg?component";
import AttachmentIcon from "@/../svg/attachment.svg?component";
import ChevronDownIcon from "@/../svg/chevron-down.svg?component";
import FaceSmileIcon from "@/../svg/face-smile.svg?component";
import MicrophoneIcon from "@/../svg/microphone.svg?component";
import { ref, watch, computed } from "vue";
import { useChatStore } from "@/Stores/useChatStore";

const chat = useChatStore();
const open = ref(true);
const overlayPanelRef = ref<InstanceType<typeof OverlayPanel> | null>(null);
const props = defineProps<{
  channel: Channel;
}>();

watch(
  () => chat.forceOpenChannel,
  async (newId) => {
    if (newId === props.channel.id) {
      // open panel
      overlayPanelRef.value?.open();

      // reset force open channel
      chat.forceOpenChannel = null;
    }
  },
  {
    immediate: true,
  }
);
</script>
