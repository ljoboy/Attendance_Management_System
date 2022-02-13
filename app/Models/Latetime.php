<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $emp_id
 * @property string $duration
 * @property string $latetime_date
 */
class Latetime extends Model
{
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
}
