<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class UserMeta extends Model
{
    use HasFactory, HashableId;

    protected $guarded = [];

    protected $hidden = ['id', 'user_id'];

    protected $appends = ['hash'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
