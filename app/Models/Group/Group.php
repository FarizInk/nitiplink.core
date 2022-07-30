<?php

namespace App\Models\Group;

use App\Http\Controllers\Api\Dev\UserController;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class Group extends Model
{
    use HasFactory, SoftDeletes, HashableId;

    protected $guarded = [];

    protected $hidden = ['id'];

    protected $appends = ['hash'];

    public function setting(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(GroupSetting::class, 'group_id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_group','group_id', 'user_id');
    }
}
