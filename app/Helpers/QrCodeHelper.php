<?php

namespace App\Helpers;

use App\Models\Employee;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeHelper
{
    public function all(): bool
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $generated = $this->generate($employee);
            if (!$generated) {
                return false;
            }
        }

        return true;
    }

    public function generate(Employee $employee): bool
    {
        $path = "/qrcodes/" . clean($employee->name) . ".png";
        $realpath = realpath(__DIR__ . "/../../public/") . $path;
        QrCode::format('png')->style('round')->size(200)->generate(
            route('qrcode.scan', [Crypt::encrypt($employee->id)]),
            $realpath
        );
        $employee->qrcode_url = $path;
        return $employee->save();
    }
}
