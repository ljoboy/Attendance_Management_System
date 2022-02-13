<?php

namespace App\Http\Controllers;

use App\Helpers\QrCodeHelper;
use App\Models\Employee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
}
