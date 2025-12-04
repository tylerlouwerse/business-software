<template>
  <footer
    class="border-t border-stone-200 shadow-lg flex items-center justify-between"
  >
    <div class="flex items-center border-r border-stone-200 h-full">
      <div
        class="w-[80px] flex flex-col items-center text-stone-400 hover:bg-gray-100 active:shadow-inner shadow-gray-300 cursor-pointer"
      >
        <SpeechBubbleIcon class="h-5 w-5" />
        <div class="text-2xs">Messages</div>
      </div>
      <div
        class="w-[80px] flex flex-col items-center text-stone-400 hover:bg-gray-100 active:shadow-inner shadow-gray-300 cursor-pointer"
      >
        <MultiUserIcon class="h-5 w-5" />
        <div class="text-2xs">Channels</div>
      </div>
      <div
        class="w-[80px] flex flex-col items-center text-stone-400 hover:bg-gray-100 active:shadow-inner shadow-gray-300 cursor-pointer"
      >
        <UserIcon class="h-5 w-5" />
        <div class="text-2xs">Contacts</div>
      </div>
    </div>

    <div class="flex items-center h-full">
      <Tooltip
        message="Directory"
        class="w-[60px] h-full flex items-center justify-center hover:bg-gray-100 text-stone-500 active:bg-gray-200 cursor-pointer border-l border-stone-200"
        placement="top"
        :offset="10"
        remove-arrow
      >
        <IdentificationIcon class="h-5 w-5" />
      </Tooltip>
      <Tooltip
        message="Time Clock"
        class="w-[60px] h-full flex items-center justify-center hover:bg-gray-100 text-stone-500 active:bg-gray-200 cursor-pointer border-l border-stone-200"
        placement="top"
        :offset="10"
        remove-arrow
      >
        <StopwatchIcon class="h-5 w-5" />
      </Tooltip>
      <Tooltip
        message="Files"
        class="w-[60px] h-full flex items-center justify-center hover:bg-gray-100 text-stone-500 active:bg-gray-200 cursor-pointer border-l border-stone-200"
        placement="top"
        :offset="10"
        remove-arrow
      >
        <FolderIcon class="h-5 w-5" />
      </Tooltip>
    </div>
  </footer>
</template>

<script lang="ts" setup>
import { Tooltip } from "@/Components/Core";
import SpeechBubbleIcon from "@/../svg/speech-bubble.svg?component";
import MultiUserIcon from "@/../svg/multi-user.svg?component";
import UserIcon from "@/../svg/user.svg?component";
import StopwatchIcon from "@/../svg/stopwatch.svg?component";
import FolderIcon from "@/../svg/folder.svg?component";
import IdentificationIcon from "@/../svg/identification.svg?component";
</script>
