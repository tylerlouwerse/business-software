<template>
  <header
    class="flex bg-primary-700 items-center justify-between p-4 text-stone-200"
  >
    <div>Dashboard</div>

    <!-- Right Side -->
    <div class="flex items-center">
      <Tooltip message="Calendar" placement="bottom" remove-arrow>
        <div
          class="flex h-[35px] w-[35px] items-center justify-center rounded-full transition duration-150 hover:bg-primary-800 active:bg-primary-600"
        >
          <CalendarIcon class="h-5 w-5" />
        </div>
      </Tooltip>
      <Tooltip message="Notifications" placement="bottom" remove-arrow>
        <div
          class="flex h-[35px] w-[35px] items-center justify-center rounded-full transition duration-150 hover:bg-primary-800 active:bg-primary-600"
        >
          <BellIcon class="h-5 w-5" />
        </div>
      </Tooltip>
      <Tooltip message="Settings" placement="bottom" remove-arrow>
        <div
          class="flex h-[35px] w-[35px] items-center justify-center rounded-full transition duration-150 hover:bg-primary-800 active:bg-primary-600 mr-1"
        >
          <CogIcon class="h-5 w-5" />
        </div>
      </Tooltip>
      <AccountDropdown />
    </div>
  </header>
</template>

<script lang="ts" setup>
import { Tooltip } from "@/Components/Core";
import CalendarIcon from "@/../svg/calendar.svg?component";
import BellIcon from "@/../svg/bell.svg?component";
import CogIcon from "@/../svg/cog.svg?component";
import AccountDropdown from "@/Components/AccountDropdown.vue";
</script>
