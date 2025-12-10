import { defineStore } from "pinia";
import { ref, onMounted } from "vue";
import axios from "axios";
import { route } from "@/Utils/route";

export const useChatStore = defineStore("chat", () => {
  const channels = ref<Channel[]>([]);
  const openChannels = ref<Channel[]>([]);
  const forceOpenChannel = ref<number | null>(null);

  const loadChannels = async () => {
    const response = await axios.get(route("channels.index"));

    channels.value = response.data;
  };

  const openChannel = (channel: Channel) => {
    forceOpenChannel.value = channel.id;

    // If the channel is already open, abort
    if (openChannels.value.some((c) => c.id === channel.id)) {
      return;
    }

    openChannels.value.push(channel);
  };

  const closeChannel = (channel: Channel) => {
    openChannels.value = openChannels.value.filter((c) => c.id !== channel.id);
  };

  onMounted(() => {
    loadChannels();
  });

  return {
    channels,
    openChannels,
    forceOpenChannel,
    openChannel,
    closeChannel,
  };
});
