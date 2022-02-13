<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Latetime;
use DateTime;
use Exception;

class AttendanceService
{
    /**
     * @throws Exception
     */
    public function addAttendee(Employee $employee, string $attendance_date = null): bool
    {
        $schedule = $employee->schedules()->get(['time_out', 'time_in'])->first();
        $employee_attendance_time = ($attendance_date) ? date('H:i:s') : $schedule->time_in;
        $attendance_date = $attendance_date ?? date('Y-m-d');

        if (!Attendance::attendable($attendance_date, $employee->id)) {
            $attendance = new Attendance();
            $attendance->emp_id = $employee->id;
            $attendance->attendance_date = $attendance_date ?? date('Y-m-d');
            $attendance->attendance_time = date('H:i:s', strtotime($schedule->time_in));
            $attendance->status = $this->checkAttendanceTime($schedule->time_in, $employee_attendance_time);

            if (!$attendance->status) {
                $late = $this->lateTime($employee, $employee_attendance_time);
            }

            return $attendance->save();
        } else {
            return false;
        }
    }

    private function checkAttendanceTime(string $schedule_time_in, string $employee_time_in): bool
    {
        return !(strtotime($schedule_time_in) >= strtotime($employee_time_in));
    }

    /**
     * @throws Exception
     */
    private function lateTime(Employee $employee, string $check_in): bool
    {
        $checkin = new DateTime($check_in);
        $schedule_time = new DateTime($employee->schedules()->first()->time_in);
        $difference = $schedule_time->diff($checkin)->format('%H:%I:%S');

        $latetime = new Latetime();
        $latetime->emp_id = $employee->id;
        $latetime->duration = $difference;
        $latetime->latetime_date = $checkin->format('Y-m-d');

        return $latetime->save();
    }
}
