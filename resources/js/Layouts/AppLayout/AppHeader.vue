<template>
  <header
    class="flex bg-primary-700 items-center justify-between p-2 text-stone-200"
  >
    <div class="flex items-center">
      <Tooltip message="Switch to..." placement="bottom" remove-arrow>
        <div
          class="flex h-[27px] w-[27px] mr-4 cursor-pointer items-center justify-center rounded-lg transition duration-150 hover:bg-primary-800 active:bg-primary-600"
        >
          <MenuGridIcon class="h-5 w-5" />
        </div>
      </Tooltip>

      <div class="flex items-center gap-x-6">
        <div class="flex cursor-pointer items-center gap-x-1">
          <div>Dashboards</div>
          <ChevronDownIcon class="h-3 w-3" />
        </div>
        <div class="flex cursor-pointer items-center gap-x-1">
          <div>Analytics</div>
          <ChevronDownIcon class="h-3 w-3" />
        </div>
        <div class="flex cursor-pointer items-center gap-x-1">
          <div>Teams</div>
          <ChevronDownIcon class="h-3 w-3" />
        </div>
        <div class="flex cursor-pointer items-center gap-x-1">
          <div>Chat</div>
        </div>
      </div>
    </div>

    <!-- Right Side -->
    <div class="flex items-center">
      <Tooltip message="Search" placement="bottom" remove-arrow>
        <div
          class="flex h-[35px] w-[35px] items-center justify-center rounded-full transition duration-150 hover:bg-primary-800 active:bg-primary-600"
        >
          <MagnifyingGlassIcon class="h-5 w-5" />
        </div>
      </Tooltip>
      <Tooltip message="Create" placement="bottom" remove-arrow>
        <div
          class="flex h-[35px] w-[35px] items-center justify-center rounded-full transition duration-150 hover:bg-primary-800 active:bg-primary-600"
        >
          <PlusIcon class="h-5 w-5" />
        </div>
      </Tooltip>
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
import MenuGridIcon from "@/../svg/menu-grid.svg?component";
import ChevronDownIcon from "@/../svg/chevron-down.svg?component";
import PlusIcon from "@/../svg/plus.svg?component";
import MagnifyingGlassIcon from "@/../svg/magnifying-glass.svg?component";
import AccountDropdown from "@/Components/AccountDropdown.vue";
</script>
