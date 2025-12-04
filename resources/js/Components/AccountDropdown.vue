<template>
  <Tooltip message="Account" placement="bottom" remove-arrow>
    <OverlayPanel sharp>
      <template #trigger>
        <div
          class="flex h-[35px] w-[35px] cursor-pointer items-center justify-center rounded-full transition duration-150 hover:bg-primary-800 active:bg-primary-600"
        >
          <div
            class="flex h-[25px] w-[25px] items-center justify-center rounded-full bg-stone-200"
          >
            <span class="text-sm font-bold text-stone-900">TL</span>
          </div>
        </div>
      </template>

      <div class="w-[300px] text-sm text-stone-900">
        <div class="border-b border-gray-200">
          <div class="mt-3 mb-2 px-3">
            <div class="text-xs font-bold">Account</div>
            <div class="my-1 flex items-center gap-x-3 py-2">
              <div
                v-if="!user.image_url"
                class="flex h-[40px] w-[40px] items-center justify-center rounded-full border border-primary-500 bg-primary-600"
              >
                <span class="text-lg font-bold text-stone-200">{{
                  user.initials
                }}</span>
              </div>

              <div
                v-else
                class="flex h-[40px] w-[40px] items-center justify-center rounded-full"
              >
                <img :src="user.image_url" class="h-full w-full rounded-full" />
              </div>

              <div>
                <div class="leading-none text-gray-800">{{ user.name }}</div>
                <div class="text-xs mt-1 leading-none text-gray-600">
                  {{ user.email }}
                </div>
              </div>
            </div>
          </div>
          <div class="border-t border-gray-200">
            <Link :href="route('account.edit')" unstyled>
              <div
                class="my-1 flex cursor-pointer items-center justify-between px-6 py-2 hover:bg-gray-100 active:bg-gray-200"
              >
                <span>Manage Account</span>
              </div>
            </Link>

            <Link :href="route('account.edit')" unstyled>
              <div
                class="my-1 flex cursor-pointer items-center justify-between px-6 py-2 hover:bg-gray-100 active:bg-gray-200"
              >
                <span>Organization Settings</span>
              </div>
            </Link>
          </div>
        </div>
        <div
          class="my-1 flex cursor-pointer justify-between px-6 py-2 hover:bg-gray-100 active:bg-gray-200"
          @click="handleLogout"
        >
          <span>Log out</span>
          <ArrowRightStartOnRectangleIcon class="h-4 w-4" />
        </div>
      </div>
    </OverlayPanel>
  </Tooltip>
</template>

<script lang="ts" setup>
import { OverlayPanel, Tooltip, Link } from "@/Components/Core";
import { router } from "@inertiajs/vue3";
import { route } from "@/Utils/route";
import { useUser } from "@/Composables/useUser";

const { user } = useUser();

const handleLogout = () => {
  router.post(route("logout"));
};
</script>
