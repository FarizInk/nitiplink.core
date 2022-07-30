<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class GroupSetting extends Model
{
    use HasFactory, HashableId;

    protected $guarded = [];

    protected $hidden = ['id', 'group_id'];

    protected $appends = ['hash'];

    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
