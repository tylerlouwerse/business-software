<template>
  <div
    class="flex min-w-[40px] flex-col items-center gap-y-2 border-r border-stone-200 bg-stone-900 p-2 text-stone-200"
  >
    <div>
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
    </div>
  </div>
</template>

<script lang="ts" setup>
import { Link, Tooltip } from "@/Components/Core";
import { route, currentRoute } from "@/Utils/route";
import HandshakeIcon from "@/../svg/handshake.svg?component";
</script>
