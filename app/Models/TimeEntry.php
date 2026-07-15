<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
     protected $fillable = ['employee_id', 'kommen', 'gehen'];

    protected $casts = [
        'kommen' => 'datetime',
        'gehen' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
