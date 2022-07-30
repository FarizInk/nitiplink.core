<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class Category extends Model
{
    use HasFactory, SoftDeletes, HashableId;

    protected $guarded = [];

    protected $appends = ['hash'];
}
