<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'comment'
    ];

    public function commentator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
