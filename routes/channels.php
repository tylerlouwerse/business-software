<?php

use App\Models\Channel;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('channel.{channelId}', function ($user, $channelId) {
    $channel = Channel::find($channelId);

    if (!$channel) {
        return false;
    }

    return $channel->members()->where('users.id', $user->id)->exists() ? [
        'id' => $user->id,
        'name' => $user->name,
    ] : false;
});

Broadcast::channel('typing.channel.{channelId}', function ($user, $channelId) {
    $channel = Channel::find($channelId);

    if (!$channel) {
        return false;
    }

    return $channel->members()->where('users.id', $user->id)->exists() ? [
        'id' => $user->id,
        'name' => $user->name,
    ] : false;
});
