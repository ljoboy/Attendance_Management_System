<?php

namespace App\Models;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static whereAttendance_date(string $date)
 * @property int $emp_id
 * @property string $attendance_date
 * @property string $attendance_time
 * @property bool $status
 */
class Attendance extends Model

{

    protected $table = 'attendances';


    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public static function attendable(string $date, int $id): ?Attendance
    {
        return self::whereAttendance_date($date)->whereEmp_id($id)->whereType(0)->first();
    }
}
