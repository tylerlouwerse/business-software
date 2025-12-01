<template>
  <AppHeader class="h-[45px]" />
  <div class="grid grid-cols-[40px_1fr] h-[calc(100vh-45px)]">
    <ModuleSelectSidebar />
    <div>
      <div class="grid grid-cols-[175px_1fr] h-[calc(100vh-75px)]">
        <AppSidebar />
        <div class="overflow-y-auto h-[calc(100vh-75px)] bg-gray-50">
          <slot />
        </div>
      </div>
      <AppFooter class="h-[30px]" />
    </div>
  </div>
</template>

<script lang="ts" setup>
import AppHeader from "./AppHeader.vue";
import ModuleSelectSidebar from "./ModuleSelectSidebar.vue";
import AppSidebar from "./AppSidebar.vue";
import AppFooter from "./AppFooter.vue";
</script>
