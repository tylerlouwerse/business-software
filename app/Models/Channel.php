<?php

namespace App\Models;

use App\Enums\ChannelType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'type' => ChannelType::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'channel_members')
            ->withPivot('joined_at')
            ->withTimestamps();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isDirect(): bool
    {
        return $this->type === ChannelType::DIRECT;
    }

    public function isGroup(): bool
    {
        return $this->type === ChannelType::GROUP;
    }

    public function getDisplayName(int $userId): string
    {
        if ($this->isDirect()) {
            $otherMember = $this->members()->where('users.id', '!=', $userId)->first();

            return $otherMember?->name ?? 'Unknown User';
        }

        return $this->name;
    }
}
