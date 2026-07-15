<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     protected $fillable = ['name'];

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }
}
