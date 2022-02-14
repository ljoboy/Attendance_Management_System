<?php

namespace App\Http\Controllers;

use App\Helpers\QrCodeHelper;
use App\Http\Requests\AttendancePinRequest;
use App\Models\Employee;
use App\Services\AttendanceService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class QrCodeController extends Controller
{

    public function __construct(private QrCodeHelper $qrcodeHelper)
    {
    }

    public function index(): Factory|View|Application
    {
        return view('admin.qrcode.index')->with(['employees' => Employee::all()]);
    }

    public function generate_all(Request $request): JsonResponse
    {
        if ($request->ajax()) {
            $this->qrcodeHelper->all();
            return response()->json(
                ['success' => true, 'message' => 'QrCodes exported successfully!'],
                Response::HTTP_CREATED
            );
        } else {
            return response()->json(
                ['success' => false, 'message' => 'Unknown error occurred!'],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function generate_one(Employee $employee): JsonResponse
    {
        $this->qrcodeHelper->generate($employee);
        return response()->json(
            ['success' => true, 'message' => "{$employee->name}'s QrCode exported successfully!"],
            Response::HTTP_CREATED
        );
    }

    /**
     * @throws Exception
     */
    public function attendanceByScan(AttendancePinRequest $request, AttendanceService $attendanceService): JsonResponse
    {
        $employee = $this->cryptedEmployee($request->post('encrypted_emp_id'));
        if (!$attendanceService->addAttendee($employee) || !Hash::check($request->post('pin'), $employee->pin_code)) {
            return response()->json(['error' => 'Failed to assign the attendance'], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['success' => 'Attendance assigned successfully'], Response::HTTP_OK);
        }
    }

    public function scan(string $encrypted_emp_id): Factory|View|Application
    {
        $employee = $this->cryptedEmployee($encrypted_emp_id);
        return view('admin.qrcode.scan')->with(['employee' => $employee, 'encrypted_emp_id' => $encrypted_emp_id]);
    }

    private function cryptedEmployee(string $encrypted_emp_id): Model|Collection|array|Employee|null
    {
        $emp_id = Crypt::decrypt($encrypted_emp_id, true);
        return Employee::findOrFail($emp_id);
    }
}
