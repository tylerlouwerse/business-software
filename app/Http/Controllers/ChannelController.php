<?php

namespace App\Http\Controllers;

use App\Events\Chat\ChannelMemberAdded;
use App\Events\Chat\ChannelMemberRemoved;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChannelController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $channels = $user->channels()
            ->with(['members', 'creator'])
            ->withCount('members')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($channel) use ($user) {
                return [
                    'id' => $channel->id,
                    'name' => $channel->getDisplayName($user->id),
                    'description' => $channel->description,
                    'type' => $channel->type,
                    'created_by' => $channel->created_by,
                    'creator' => $channel->creator,
                    'members_count' => $channel->members_count,
                    'members' => $channel->members,
                    'updated_at' => $channel->updated_at,
                ];
            });

        return response()->json($channels);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'member_ids' => 'required|array|min:1',
            'member_ids.*' => 'exists:users,id',
        ]);

        $user = $request->user();

        $channel = DB::transaction(function () use ($validated, $user) {
            $channel = Channel::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'type' => 'group',
                'created_by' => $user->id,
            ]);

            $memberIds = array_unique(array_merge([$user->id], $validated['member_ids']));
            $channel->members()->attach($memberIds, ['joined_at' => now()]);

            return $channel->load(['members', 'creator']);
        });

        return response()->json($channel, 201);
    }

    public function show(Channel $channel)
    {
        $user = request()->user();

        if (!$channel->members()->where('users.id', $user->id)->exists()) {
            abort(403, 'You are not a member of this channel.');
        }

        $channel->load(['members', 'creator']);

        return response()->json([
            'id' => $channel->id,
            'name' => $channel->getDisplayName($user->id),
            'description' => $channel->description,
            'type' => $channel->type,
            'created_by' => $channel->created_by,
            'creator' => $channel->creator,
            'members' => $channel->members,
        ]);
    }

    public function update(Request $request, Channel $channel)
    {
        $user = $request->user();

        if (!$channel->members()->where('users.id', $user->id)->exists()) {
            abort(403, 'You are not a member of this channel.');
        }

        if ($channel->isDirect()) {
            abort(403, 'Direct messages cannot be updated.');
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $channel->update($validated);
        $channel->load(['members', 'creator']);

        return response()->json($channel);
    }

    public function destroy(Channel $channel)
    {
        $user = request()->user();

        if ($channel->created_by !== $user->id) {
            abort(403, 'Only the channel creator can delete the channel.');
        }

        $channel->delete();

        return response()->json(['message' => 'Channel deleted successfully']);
    }

    public function addMember(Request $request, Channel $channel)
    {
        $user = $request->user();

        if (!$channel->members()->where('users.id', $user->id)->exists()) {
            abort(403, 'You are not a member of this channel.');
        }

        if ($channel->isDirect()) {
            abort(403, 'Cannot add members to direct messages.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if ($channel->members()->where('users.id', $validated['user_id'])->exists()) {
            return response()->json(['message' => 'User is already a member'], 422);
        }

        $channel->members()->attach($validated['user_id'], ['joined_at' => now()]);

        $newMember = User::find($validated['user_id']);
        broadcast(new ChannelMemberAdded($channel, $newMember));

        return response()->json(['message' => 'Member added successfully']);
    }

    public function removeMember(Request $request, Channel $channel)
    {
        $user = $request->user();
        $targetUserId = $request->input('user_id');

        if (!$channel->members()->where('users.id', $user->id)->exists()) {
            abort(403, 'You are not a member of this channel.');
        }

        if ($channel->isDirect()) {
            abort(403, 'Cannot remove members from direct messages.');
        }

        if ($targetUserId && $targetUserId !== $user->id && $channel->created_by !== $user->id) {
            abort(403, 'You can only remove yourself or be removed by the channel creator.');
        }

        $targetUserId = $targetUserId ?? $user->id;
        $removedUser = User::find($targetUserId);

        $channel->members()->detach($targetUserId);

        broadcast(new ChannelMemberRemoved($channel, $removedUser));

        return response()->json(['message' => 'Member removed successfully']);
    }

    public function findOrCreateDirect(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = $request->user();
        $targetUserId = $validated['user_id'];

        if ($user->id === $targetUserId) {
            abort(422, 'Cannot create a direct message with yourself.');
        }

        // Check if a direct channel already exists between these two users
        $existingChannel = Channel::where('type', 'direct')
            ->whereHas('members', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->whereHas('members', function ($query) use ($targetUserId) {
                $query->where('users.id', $targetUserId);
            })
            ->withCount('members')
            ->having('members_count', '=', 2)
            ->first();

        if ($existingChannel) {
            $existingChannel->load(['members', 'creator']);

            return response()->json($existingChannel);
        }

        // Create new direct channel
        $channel = DB::transaction(function () use ($user, $targetUserId) {
            $channel = Channel::create([
                'name' => null,
                'description' => null,
                'type' => 'direct',
                'created_by' => $user->id,
            ]);

            $channel->members()->attach([$user->id, $targetUserId], ['joined_at' => now()]);

            return $channel->load(['members', 'creator']);
        });

        return response()->json($channel, 201);
    }
}
