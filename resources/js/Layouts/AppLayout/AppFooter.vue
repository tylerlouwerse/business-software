<template>
  <footer class="border-t border-stone-200 shadow-lg flex items-center">
    <div class="flex items-center border-r border-stone-200">
      <div class="flex items-center">
        <div
          class="w-[80px] flex flex-col items-center text-stone-400 hover:bg-gray-100 active:shadow-inner shadow-gray-300 cursor-pointer"
        >
          <SpeechBubbleIcon class="h-5 w-5" />
          <div class="text-2xs">Chats</div>
        </div>
      </div>
      <div class="flex items-center">
        <div
          class="w-[80px] flex flex-col items-center text-stone-400 hover:bg-gray-100 active:shadow-inner shadow-gray-300 cursor-pointer"
        >
          <MultiUserIcon class="h-5 w-5" />
          <div class="text-2xs">Channels</div>
        </div>
      </div>
      <div class="flex items-center">
        <div
          class="w-[80px] flex flex-col items-center text-stone-400 hover:bg-gray-100 active:shadow-inner shadow-gray-300 cursor-pointer"
        >
          <UserIcon class="h-5 w-5" />
          <div class="text-2xs">Contacts</div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script lang="ts" setup>
import SpeechBubbleIcon from "@/../svg/speech-bubble.svg?component";
import MultiUserIcon from "@/../svg/multi-user.svg?component";
import UserIcon from "@/../svg/user.svg?component";
</script>
