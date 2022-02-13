<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $schedules
 * @property mixed|string $qrcode_url
 * @property mixed $id
 */
class Employee extends Model
{
    use HasFactory, Notifiable;

    public function getRouteKeyName(): string
    {
        return 'name';
    }
    protected $table = 'employees';
    protected $fillable = [
        'name', 'email', 'pin_code', 'qrcode_url'
    ];


    protected $hidden = [
        'pin_code', 'remember_token',
    ];


    public function check(): HasMany
    {
        return $this->hasMany(Check::class);
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function latetime(): HasMany
    {
        return $this->hasMany(Latetime::class);
    }

    public function leave(): HasMany
    {
        return $this->hasMany(Leave::class);
    }

    public function overtime(): HasMany
    {
        return $this->hasMany(Overtime::class);
    }

    public function schedules(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Schedule', 'schedule_employees', 'emp_id', 'schedule_id');
    }




}
