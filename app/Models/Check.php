<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Check extends Model
{
    public function employees(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
