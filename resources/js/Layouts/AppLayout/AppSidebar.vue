<template>
  <div
    class="flex h-full min-w-[175px] flex-col gap-y-0.5 border-r border-stone-200 bg-gray-50 p-3 text-sm"
  >
    <Link
      v-for="item in navigation"
      :key="item.name"
      :href="route(item.href)"
      class="rounded-sm p-1 text-stone-800"
      :class="{
        'bg-primary-50': currentRoute(item.current),
        'hover:bg-primary-50 active:bg-primary-100': !currentRoute(
          item.current
        ),
      }"
    >
      {{ item.name }}
    </Link>
  </div>
</template>

<script lang="ts" setup>
import { Link } from "@/Components/Core";
import { route, currentRoute } from "@/Utils/route";

const navigation = [
  { name: "Leads", href: "crm.leads.index", current: "crm.leads.*" },
  { name: "Accounts", href: "crm.accounts.index", current: "crm.accounts.*" },
  { name: "Deals", href: "crm.deals.index", current: "crm.deals.*" },
  {
    name: "Activities",
    href: "crm.activities.index",
    current: "crm.activities.*",
  },
];
</script>
