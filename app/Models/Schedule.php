<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $slug
 * @property mixed $time_in
 * @property mixed $time_out
 */
class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'time_in', 'time_out'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Employee', 'schedule_employees', 'schedule_id', 'emp_id');
    }
}
