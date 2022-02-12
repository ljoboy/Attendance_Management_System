<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class QrCodeController extends Controller
{
    public function index(): Factory|View|Application {
        return view('admin.qrcode.index')->with(['employees' => Employee::all()]);
    }
}
