<?php

namespace App\Modules\Backend\Export\Controllers;

use App\Exports\LecturerExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;

class ExportController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'permission:edit-any']);
    }

    public function index()
    {
        $init = Schema::getColumnListing('lecturers');
        
        $lecturerColumns = array_values(array_diff($init, ['id', 'created_at','updated_at']));

        return view('Export::index')->with([
            'lecturerColumns' => $lecturerColumns
        ]);
    }

    public function employee_export(Request $request)
    {
        Excel::store(new LecturerExport(), 'Employees.csv', 'public');
        return new LecturerExport();
    }
}
