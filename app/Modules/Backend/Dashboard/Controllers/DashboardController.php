<?php
namespace App\Modules\Backend\Dashboard\Controllers;

// use App\Dashboard\Lecturer\Model\Lecturer;
// use App\Exports\LecturerExport;
// use Carbon\Carbon;
// use Faker\Factory;
// use Illuminate\Http\Request;
// use Illuminate\Support\Str;
// use Maatwebsite\Excel\Facades\Excel;
// use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'permission:view-lecturer|create-lecturer|update-lecturer|delete-lecturer']);
    }

    public function index()
    {
        return view('Dashboard::index');
    }
}
