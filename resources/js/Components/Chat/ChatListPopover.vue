<template>
  <OverlayPanel
    v-model:visible="open"
    placement="top-start"
    unstyled
    :offset="1"
  >
    <template #trigger>
      <div
        class="w-[83.3px] h-[29px] flex flex-col items-center hover:bg-gray-100 active:shadow-inner shadow-gray-300 cursor-pointer"
        :class="{
          'text-primary-400': open,
          'text-gray-400': !open,
        }"
      >
        <SpeechBubbleIcon class="h-5 w-5" />
        <div class="text-2xs">Messages</div>
      </div>
    </template>

    <div
      class="bg-white rounded-t-lg h-[450px] w-[250px] shadow-[6px_-6px_12px_0_rgba(0,0,0,0.08),6px_0px_12px_0_rgba(0,0,0,0.06)]"
    >
      <!-- Header -->
      <div
        class="flex items-center justify-between gap-x-3 p-2 border-b border-gray-200"
      >
        <div>
          <div
            class="flex h-[25px] w-[25px] items-center justify-center rounded-full bg-primary-200"
          >
            <span class="font-bold text-gray-600 text-sm">TL</span>
          </div>
        </div>
        <div class="flex-1">
          <div class="text-xs text-gray-800 font-bold">Tyler Louwerse</div>
          <div class="text-xs text-gray-400 leading-4">Engaged at work</div>
        </div>
        <div>
          <div class="mb-1">
            <MinusIcon
              class="h-4 w-4 text-gray-500 hover:text-gray-700 cursor-pointer"
              @click="open = false"
            />
          </div>
          <div>
            <EllipsisCircleFilledIcon
              class="h-4 w-4 text-gray-400 hover:text-gray-500 cursor-pointer"
            />
          </div>
        </div>
      </div>
      <!-- Search -->
      <div class="flex items-center border-b border-gray-200">
        <div class="py-1.5 px-2">
          <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" />
        </div>
        <input
          class="w-full py-1.5 pr-2 ring-0 focus:outline-none text-gray-600 text-sm"
          type="text"
          placeholder="Search Contacts, Chats & Channels"
        />
      </div>

      <div class="overflow-y-auto h-[calc(100%-75px)]">
        <!-- Pinned -->
        <div class="p-2 mb-2">
          <div class="text-sm font-semibold mb-2 text-gray-600">My Pins</div>
          <div class="flex items-center gap-x-2">
            <div
              class="flex h-[35px] w-[35px] items-center justify-center rounded-full bg-pink-200"
            >
              <span class="font-bold text-gray-600 text-lg">TM</span>
            </div>

            <div
              class="flex h-[35px] w-[35px] items-center justify-center rounded-full bg-red-200"
            >
              <span class="font-bold text-gray-600 text-lg">RV</span>
            </div>

            <div
              class="flex h-[35px] w-[35px] items-center justify-center rounded-full bg-purple-200"
            >
              <span class="font-bold text-gray-600 text-lg">KL</span>
            </div>
          </div>
        </div>

        <!-- Chats -->
        <div>
          <div class="text-sm font-semibold mb-1 text-gray-600 px-2">
            Recent Chats
          </div>
          <div>
            <div
              class="px-2 flex items-center gap-x-3 hover:bg-primary-50 active:bg-primary-100 p-2 transition-colors cursor-pointer"
            >
              <div
                class="flex h-[35px] w-[35px] items-center justify-center rounded-full bg-pink-200"
              >
                <span class="font-bold text-gray-600 text-lg">TM</span>
              </div>
              <div class="flex-1">
                <div class="text-sm text-gray-800 font-semibold">
                  Twyla Marsman
                </div>
                <div class="text-xs text-gray-400">Love you pookie dookie!</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </OverlayPanel>
</template>

<script lang="ts" setup>
import { OverlayPanel } from "@/Components/Core";
import SpeechBubbleIcon from "@/../svg/speech-bubble.svg?component";
import MinusIcon from "@/../svg/minus.svg?component";
import MagnifyingGlassIcon from "@/../svg/magnifying-glass.svg?component";
import EllipsisCircleFilledIcon from "@/../svg/ellipsis-circle-filled.svg?component";
import { ref } from "vue";

const open = ref(false);
</script>
