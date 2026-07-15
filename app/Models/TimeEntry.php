<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    protected $fillable = ['user_id', 'kommen', 'gehen'];

    protected $casts = [
        'kommen' => 'datetime',
        'gehen' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
