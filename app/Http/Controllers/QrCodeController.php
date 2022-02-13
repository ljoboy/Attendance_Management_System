<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\Response;

class QrCodeController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('admin.qrcode.index')->with(['employees' => Employee::all()]);
    }

    public function generate_all(Request $request): JsonResponse
    {
        if ($request->ajax()) {
            $employees = Employee::all();

            foreach ($employees as $employee) {
                $qrcode = realpath(__DIR__ . "/../../../public/qrcodes") . "/" . clean($employee->name) . ".svg";
                QrCode::generate(
                    Crypt::encryptString($employee->id),
                    $qrcode
                );
            }
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
}
