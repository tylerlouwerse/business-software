<template>
  <div
    class="flex min-w-[40px] flex-col items-center gap-y-2 border-r border-stone-200 bg-stone-900 p-2 text-stone-200"
  >
    <div class="flex flex-col gap-y-2">
      <Tooltip message="CRM" placement="right" remove-arrow>
        <Link :href="route('crm')">
          <div
            class="rounded-md p-1"
            :class="{
              'bg-primary-100': currentRoute('crm.*'),
              'hover:bg-stone-700 active:bg-stone-800': !currentRoute('crm.*'),
            }"
          >
            <HandshakeIcon class="h-6 w-6 text-stone-300" />
          </div>
        </Link>
      </Tooltip>
      <Tooltip message="HRIS" placement="right" remove-arrow>
        <Link :href="route('hris')">
          <div
            class="rounded-md p-1"
            :class="{
              'bg-primary-100': currentRoute('hris.*'),
              'hover:bg-stone-700 active:bg-stone-800': !currentRoute('hris.*'),
            }"
          >
            <UserGroupIcon class="h-6 w-6 text-stone-300" />
          </div>
        </Link>
      </Tooltip>
      <Tooltip message="Projects" placement="right" remove-arrow>
        <Link :href="route('projects')">
          <div
            class="rounded-md p-1"
            :class="{
              'bg-primary-100': currentRoute('projects.*'),
              'hover:bg-stone-700 active:bg-stone-800':
                !currentRoute('projects.*'),
            }"
          >
            <CheckmarkIcon class="h-6 w-6 text-stone-300" />
          </div>
        </Link>
      </Tooltip>
      <Tooltip message="Finance" placement="right" remove-arrow>
        <Link :href="route('finance')">
          <div
            class="rounded-md p-1"
            :class="{
              'bg-primary-100': currentRoute('finance.*'),
              'hover:bg-stone-700 active:bg-stone-800':
                !currentRoute('finance.*'),
            }"
          >
            <BanknotesIcon class="h-6 w-6 text-stone-300" />
          </div>
        </Link>
      </Tooltip>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { Link, Tooltip } from "@/Components/Core";
import { route, currentRoute } from "@/Utils/route";
import HandshakeIcon from "@/../svg/handshake.svg?component";
import UserGroupIcon from "@/../svg/user-group.svg?component";
import BanknotesIcon from "@/../svg/banknotes.svg?component";
import CheckmarkIcon from "@/../svg/checkmark.svg?component";
</script>
