<template>
  <footer
    class="border-t border-gray-200 shadow-lg flex items-center justify-between"
  >
    <div class="flex items-center border-r border-gray-200 h-full">
      <MessagesPopover />
      <div
        class="w-[80px] flex flex-col items-center text-gray-400 hover:bg-gray-100 active:shadow-inner shadow-gray-300 cursor-pointer"
      >
        <MultiUserIcon class="h-5 w-5" />
        <div class="text-2xs">Channels</div>
      </div>
      <div
        class="w-[80px] flex flex-col items-center text-gray-400 hover:bg-gray-100 active:shadow-inner shadow-gray-300 cursor-pointer"
      >
        <UserIcon class="h-5 w-5" />
        <div class="text-2xs">Contacts</div>
      </div>
    </div>

    <div class="flex items-center h-full">
      <Tooltip
        message="Directory"
        class="w-[60px] h-full flex items-center justify-center hover:bg-gray-100 text-gray-500 active:bg-gray-200 cursor-pointer border-l border-gray-200"
        placement="top"
        :offset="10"
        remove-arrow
      >
        <IdentificationIcon class="h-5 w-5" />
      </Tooltip>
      <Tooltip
        message="Time Clock"
        class="w-[60px] h-full flex items-center justify-center hover:bg-gray-100 text-gray-500 active:bg-gray-200 cursor-pointer border-l border-gray-200"
        placement="top"
        :offset="10"
        remove-arrow
      >
        <StopwatchIcon class="h-5 w-5" />
      </Tooltip>
      <Tooltip
        message="Files"
        class="w-[60px] h-full flex items-center justify-center hover:bg-gray-100 text-gray-500 active:bg-gray-200 cursor-pointer border-l border-gray-200"
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
import MessagesPopover from "@/Components/Chat/MessagesPopover.vue";
import MultiUserIcon from "@/../svg/multi-user.svg?component";
import UserIcon from "@/../svg/user.svg?component";
import StopwatchIcon from "@/../svg/stopwatch.svg?component";
import FolderIcon from "@/../svg/folder.svg?component";
import IdentificationIcon from "@/../svg/identification.svg?component";
</script>
